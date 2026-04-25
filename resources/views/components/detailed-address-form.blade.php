<div x-data="detailedAddress()" x-init="init()" class="space-y-4">
    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">
                <i class="fas fa-user mr-1 text-accent"></i> Full Name
            </label>
            <input type="text" name="full_name" x-model="fullName" required 
                   class="w-full rounded-lg input-glow"
                   placeholder="John Doe"
                   value="{{ auth()->user()->name ?? '' }}">
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">
                <i class="fas fa-phone mr-1 text-accent"></i> Phone Number
            </label>
            <input type="tel" name="phone" x-model="phone" required 
                   class="w-full rounded-lg input-glow"
                   placeholder="+1 (555) 000-0000">
            <p class="text-xs text-gray-500 mt-1">For delivery updates</p>
        </div>
    </div>
    
    <div>
        <label class="block text-sm font-medium text-gray-300 mb-2">
            <i class="fas fa-location-dot mr-1 text-accent"></i> Street Address
        </label>
        <div x-data="addressAutocomplete()" x-init="init()" class="relative">
            <input type="text" 
                   x-model="streetAddress"
                   @input="handleInput"
                   @keydown.down.prevent="selectNext"
                   @keydown.up.prevent="selectPrev"
                   @keydown.enter.prevent="selectCurrent"
                   name="street_address"
                   class="w-full rounded-lg input-glow"
                   placeholder="Street address, P.O. Box, etc.">
            
            <div x-show="suggestions.length > 0 && showSuggestions" 
                 x-transition
                 class="absolute z-50 w-full mt-1 glass-card rounded-lg shadow-xl max-h-48 overflow-y-auto">
                <template x-for="(suggestion, index) in suggestions" :key="index">
                    <div @click="selectSuggestion(suggestion)"
                         class="px-4 py-2 hover:bg-primary-light/20 cursor-pointer text-sm border-b border-primary-light/30 last:border-0"
                         :class="{'bg-primary-light/20': selectedIndex === index}">
                        <div class="flex items-start gap-2">
                            <i class="fas fa-map-pin text-accent text-xs mt-1"></i>
                            <span x-text="suggestion.main_text"></span>
                        </div>
                    </div>
                </template>
            </div>
            
            <div x-show="loading" class="absolute right-3 top-3">
                <i class="fas fa-spinner fa-spin text-accent"></i>
            </div>
        </div>
    </div>
    
    <div class="grid md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">City</label>
            <input type="text" name="city" x-model="city" required
                   class="w-full rounded-lg input-glow"
                   placeholder="New York">
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">State</label>
            <select name="state" x-model="state" class="w-full rounded-lg input-glow">
                <option value="">Select State</option>
                <option value="AL">Alabama</option>
                <option value="AK">Alaska</option>
                <option value="AZ">Arizona</option>
                <option value="AR">Arkansas</option>
                <option value="CA">California</option>
                <option value="CO">Colorado</option>
                <option value="CT">Connecticut</option>
                <option value="DE">Delaware</option>
                <option value="FL">Florida</option>
                <option value="GA">Georgia</option>
                <option value="HI">Hawaii</option>
                <option value="ID">Idaho</option>
                <option value="IL">Illinois</option>
                <option value="IN">Indiana</option>
                <option value="IA">Iowa</option>
                <option value="KS">Kansas</option>
                <option value="KY">Kentucky</option>
                <option value="LA">Louisiana</option>
                <option value="ME">Maine</option>
                <option value="MD">Maryland</option>
                <option value="MA">Massachusetts</option>
                <option value="MI">Michigan</option>
                <option value="MN">Minnesota</option>
                <option value="MS">Mississippi</option>
                <option value="MO">Missouri</option>
                <option value="MT">Montana</option>
                <option value="NE">Nebraska</option>
                <option value="NV">Nevada</option>
                <option value="NH">New Hampshire</option>
                <option value="NJ">New Jersey</option>
                <option value="NM">New Mexico</option>
                <option value="NY">New York</option>
                <option value="NC">North Carolina</option>
                <option value="ND">North Dakota</option>
                <option value="OH">Ohio</option>
                <option value="OK">Oklahoma</option>
                <option value="OR">Oregon</option>
                <option value="PA">Pennsylvania</option>
                <option value="RI">Rhode Island</option>
                <option value="SC">South Carolina</option>
                <option value="SD">South Dakota</option>
                <option value="TN">Tennessee</option>
                <option value="TX">Texas</option>
                <option value="UT">Utah</option>
                <option value="VT">Vermont</option>
                <option value="VA">Virginia</option>
                <option value="WA">Washington</option>
                <option value="WV">West Virginia</option>
                <option value="WI">Wisconsin</option>
                <option value="WY">Wyoming</option>
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">ZIP Code</label>
            <input type="text" name="zip_code" x-model="zip" required
                   class="w-full rounded-lg input-glow"
                   placeholder="10001"
                   maxlength="10">
        </div>
    </div>
    
    <div>
        <label class="block text-sm font-medium text-gray-300 mb-2">Address Type</label>
        <div class="flex gap-4 flex-wrap">
            <label class="flex items-center gap-2 cursor-pointer hover:text-accent transition-colors">
                <input type="radio" name="address_type" value="home" x-model="addressType" class="w-4 h-4 text-accent">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer hover:text-accent transition-colors">
                <input type="radio" name="address_type" value="work" x-model="addressType" class="w-4 h-4 text-accent">
                <i class="fas fa-briefcase"></i>
                <span>Work</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer hover:text-accent transition-colors">
                <input type="radio" name="address_type" value="other" x-model="addressType" class="w-4 h-4 text-accent">
                <i class="fas fa-map-marker-alt"></i>
                <span>Other</span>
            </label>
        </div>
    </div>
    
    <!-- Delivery Instructions -->
    <div>
        <label class="block text-sm font-medium text-gray-300 mb-2">
            <i class="fas fa-note-sticky mr-1 text-accent"></i> Delivery Instructions (Optional)
        </label>
        <textarea name="delivery_instructions" rows="2" 
                  class="w-full rounded-lg input-glow"
                  placeholder="Gate code, building number, landmark, etc."></textarea>
    </div>
    
    <!-- Address Preview -->
    <div x-show="fullAddress" x-transition class="p-3 bg-accent/10 rounded-lg border border-accent/30">
        <div class="flex items-start gap-2">
            <i class="fas fa-check-circle text-accent mt-0.5"></i>
            <div>
                <p class="text-sm font-semibold text-accent">Delivery Address Preview</p>
                <p class="text-sm text-gray-300" x-text="fullAddressPreview"></p>
            </div>
        </div>
    </div>
    
    <input type="hidden" name="shipping_address" :value="fullAddress">
    <input type="hidden" name="latitude" x-model="latitude">
    <input type="hidden" name="longitude" x-model="longitude">
</div>

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
                    `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(this.address)}&format=json&addressdetails=1&limit=5`
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
            
            const input = this.$el.querySelector('input');
            if (input) {
                input.value = suggestion.full_address;
            }
            
            const event = new CustomEvent('address-selected-street', { 
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

function detailedAddress() {
    return {
        fullName: '',
        phone: '',
        streetAddress: '',
        city: '',
        state: '',
        zip: '',
        addressType: 'home',
        latitude: null,
        longitude: null,
        
        get fullAddress() {
            return `${this.streetAddress}, ${this.city}, ${this.state} ${this.zip}`.trim();
        },
        
        get fullAddressPreview() {
            let preview = '';
            if (this.fullName) preview += this.fullName + '\n';
            if (this.streetAddress) preview += this.streetAddress + '\n';
            if (this.city) preview += this.city + ', ';
            if (this.state) preview += this.state + ' ';
            if (this.zip) preview += this.zip;
            if (this.phone) preview += '\n📞 ' + this.phone;
            return preview;
        },
        
        init() {
            // Listen for street address selection
            document.addEventListener('address-selected-street', (e) => {
                const details = e.detail.details;
                if (details) {
                    if (details.road || details.pedestrian) {
                        this.streetAddress = details.road || details.pedestrian || '';
                        if (details.house_number) {
                            this.streetAddress = details.house_number + ' ' + this.streetAddress;
                        }
                    }
                    this.city = details.city || details.town || details.village || '';
                    this.state = details.state || '';
                    this.zip = details.postcode || '';
                    this.latitude = e.detail.lat;
                    this.longitude = e.detail.lon;
                }
            });
            
            // Pre-fill name from auth user if available
            @auth
            this.fullName = '{{ auth()->user()->name }}';
            @endauth
        }
    };
}
</script>