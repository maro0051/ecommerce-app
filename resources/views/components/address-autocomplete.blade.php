<div x-data="addressAutocomplete()" x-init="init()" class="relative">
    <div class="relative">
        <textarea x-model="address" 
                  @input="handleInput"
                  @keydown.down.prevent="selectNext"
                  @keydown.up.prevent="selectPrev"
                  @keydown.enter.prevent="selectCurrent"
                  @blur="hideSuggestions"
                  name="shipping_address"
                  id="shipping_address"
                  rows="3"
                  required
                  {{ $attributes->merge(['class' => 'w-full rounded-lg input-glow', 'placeholder' => 'Enter your complete shipping address...']) }}
        >{{ $value ?? '' }}</textarea>
        
        <div x-show="loading" class="absolute right-3 bottom-3">
            <i class="fas fa-spinner fa-spin text-accent"></i>
        </div>
    </div>
    
    <!-- Suggestions Dropdown -->
    <div x-show="suggestions.length > 0 && showSuggestions" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         class="absolute z-50 w-full mt-1 glass-card rounded-lg shadow-xl max-h-60 overflow-y-auto"
         style="display: none;">
        
        <template x-for="(suggestion, index) in suggestions" :key="index">
            <div @click="selectSuggestion(suggestion)"
                 class="address-suggestion px-4 py-3 hover:bg-primary-light/20 cursor-pointer transition-colors border-b border-primary-light/30 last:border-0"
                 :class="{'bg-primary-light/20': selectedIndex === index}">
                <div class="flex items-start gap-3">
                    <i class="fas fa-map-marker-alt text-accent mt-1"></i>
                    <div>
                        <p class="text-sm font-medium" x-text="suggestion.main_text"></p>
                        <p class="text-xs text-gray-400" x-text="suggestion.secondary_text"></p>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>

<style>
.address-suggestion {
    transition: all 0.2s ease;
}
.address-suggestion:hover {
    background: rgba(59, 130, 246, 0.2);
    transform: translateX(5px);
}
</style>

<script>
function addressAutocomplete() {
    return {
        address: '',
        suggestions: [],
        showSuggestions: false,
        selectedIndex: -1,
        loading: false,
        debounceTimer: null,
        
        init() {
            this.searchAPI = 'https://nominatim.openstreetmap.org/search';
        },
        
        handleInput(e) {
            this.address = e.target.value;
            this.selectedIndex = -1;
            
            if (this.debounceTimer) clearTimeout(this.debounceTimer);
            
            if (this.address.length < 3) {
                this.suggestions = [];
                this.showSuggestions = false;
                return;
            }
            
            this.debounceTimer = setTimeout(() => {
                this.searchAddress();
            }, 500);
        },
        
        async searchAddress() {
            this.loading = true;
            this.showSuggestions = true;
            
            try {
                const response = await fetch(
                    `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(this.address)}&format=json&addressdetails=1&limit=5&countrycodes=us,ca,uk,au,in`
                );
                const data = await response.json();
                
                this.suggestions = data.map(item => ({
                    main_text: item.display_name.split(',')[0],
                    secondary_text: item.display_name.split(',').slice(1).join(',').trim(),
                    full_address: item.display_name,
                    lat: item.lat,
                    lon: item.lon,
                    details: item.address
                }));
                
            } catch (error) {
                console.error('Address search error:', error);
                this.suggestions = [];
            } finally {
                this.loading = false;
            }
        },
        
        selectSuggestion(suggestion) {
            this.address = suggestion.full_address;
            this.showSuggestions = false;
            this.suggestions = [];
            
            // Update the textarea value
            const textarea = document.getElementById('shipping_address');
            if (textarea) {
                textarea.value = suggestion.full_address;
            }
            
            // Dispatch address selected event with full details
            const event = new CustomEvent('address-selected', { 
                detail: suggestion,
                bubbles: true 
            });
            this.$el.dispatchEvent(event);
        },
        
        selectNext() {
            if (this.selectedIndex < this.suggestions.length - 1) {
                this.selectedIndex++;
                this.scrollToSelected();
            }
        },
        
        selectPrev() {
            if (this.selectedIndex > 0) {
                this.selectedIndex--;
                this.scrollToSelected();
            }
        },
        
        selectCurrent() {
            if (this.selectedIndex >= 0 && this.suggestions[this.selectedIndex]) {
                this.selectSuggestion(this.suggestions[this.selectedIndex]);
            }
        },
        
        scrollToSelected() {
            const selected = document.querySelector('.bg-primary-light\\/20');
            if (selected) {
                selected.scrollIntoView({ block: 'nearest' });
            }
        },
        
        hideSuggestions() {
            setTimeout(() => {
                this.showSuggestions = false;
            }, 200);
        }
    };
}
</script>