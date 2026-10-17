<?php
/**
 * WanderWise India - Centralized Travel Packages & 3-Tier Plans Data (INR / ₹)
 */

$packages = [
    [
        'id' => 'kashmir-paradise',
        'title' => 'Kashmir Paradise: Srinagar, Gulmarg & Pahalgam',
        'tagline' => 'Heaven on Earth with Dal Lake houseboats, snow peaks & saffron meadows',
        'country' => 'India',
        'location' => 'Jammu & Kashmir (Srinagar, Gulmarg, Pahalgam & Sonamarg)',
        'category' => 'Himalayas & Snow',
        'rating' => 4.95,
        'reviews_count' => 420,
        'duration' => '6 Days / 5 Nights',
        'group_size' => '2 - 12 Travelers',
        'best_season' => 'All Season (Summer blooms & Winter snowfall)',
        'badge' => 'Top Rated Yatra',
        'featured' => true,
        'hero_image' => 'https://images.unsplash.com/photo-1595815771614-ade9d652a65d?auto=format&fit=crop&w=1200&q=80',
        'gallery' => [
            'https://images.unsplash.com/photo-1595815771614-ade9d652a65d?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1566837945700-30057527ade0?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=800&q=80'
        ],
        'overview' => 'Experience the ethereal beauty of Kashmir, rightfully crowned "Jannat" (Paradise on Earth). Cruise gently on Dal Lake in a traditional wooden Shikara, ride the world’s second-highest Gulmarg Gondola cable car above snow-draped pine forests, stroll through fragrant saffron fields in Pampore, and unwind in luxurious heritage houseboats.',
        'highlights' => [
            'Romantic sunset Shikara ride on Dal Lake with floating flower market',
            'Gulmarg Gondola cable car ride to Apharwat peak (Phase 1 & 2)',
            'Visit Betaab Valley, Aru Valley and Chandanwari in Pahalgam',
            'Mughal Gardens of Srinagar (Nishat Bagh, Shalimar Bagh & Chashme Shahi)',
            'Authentic Kashmiri Wazwan feast & hot Kahwa tea tasting'
        ],
        'plans' => [
            'explorer' => [
                'name' => 'Explorer Plan',
                'type' => 'Budget Friendly / Backpacker Yatra',
                'price' => 17999,
                'discount_price' => 14999,
                'badge' => 'Budget Friendly',
                'hotel' => '3-Star Deluxe Hotel in Srinagar & Standard Heritage Houseboat on Dal Lake',
                'transport' => 'Shared AC Tempo Traveler / Etios with experienced local driver',
                'meals' => 'Daily buffet breakfast + 1 Traditional Kashmiri Dinner with Kahwa',
                'guide' => 'Local Hindi/English-speaking group tour guide for excursions',
                'features' => [
                    'Cozy 3-star mountain view rooms with central heating / electric blankets',
                    '1-Hour complimentary Shikara boat ride on Dal Lake',
                    'All intercity transfers from Srinagar Airport and back',
                    'Shared transfer to Gulmarg and Pahalgam valleys',
                    '24/7 WhatsApp travel coordinator support'
                ],
                'inclusions' => [
                    '5 Nights accommodation (4 nights hotel + 1 night Dal Lake houseboat)',
                    'Daily fresh breakfast',
                    'Srinagar airport pick-up & drop-off',
                    'Toll taxes, parking fees, and driver allowances'
                ],
                'exclusions' => [
                    'Flight/train tickets to Srinagar',
                    'Gondola ride tickets (optional add-on)',
                    'Pony rides or local Pahalgam Union taxi'
                ]
            ],
            'comfort' => [
                'name' => 'Comfort Plan',
                'type' => 'Most Popular / Premium Family & Honeymoon',
                'price' => 28999,
                'discount_price' => 24999,
                'badge' => 'Most Popular',
                'hotel' => '4-Star Luxury Resort in Gulmarg & Super Deluxe Carved Wooden Houseboat',
                'transport' => 'Dedicated Private AC Sedan (Dzire / Etios) with private chauffeur',
                'meals' => 'Daily breakfast, 3 lunches & 2 royal multi-course Wazwan dinners',
                'guide' => 'Private certified local guide throughout sightseeing',
                'features' => [
                    '4-star premium resorts with panoramic snow-capped valley views',
                    'Private car and personal driver for your entire family/couple',
                    'Guaranteed Gulmarg Gondola Phase 1 cable car passes included',
                    '2-Hour extended Dal Lake & Nigeen Lake sunset Shikara cruise',
                    'Complimentary traditional Kashmiri attire photoshoot on Dal Lake',
                    'Full travel insurance coverage included'
                ],
                'inclusions' => [
                    '5 Nights in 4-star superior hotels & luxury pine-wood houseboats',
                    'Daily gourmet breakfast + 5 curated authentic meals',
                    'Private AC vehicle for all 6 days with no kilometer limit',
                    'Gondola Phase 1 tickets',
                    'All monument and garden entry tickets'
                ],
                'exclusions' => [
                    'Airfare to/from Srinagar',
                    'Personal shopping (Pashmina shawls, dry fruits)'
                ]
            ],
            'luxury' => [
                'name' => 'Royal Maharaja VIP Plan',
                'type' => '5-Star Grand Luxury & Private SUV',
                'price' => 58999,
                'discount_price' => 49999,
                'badge' => 'Maharaja Experience',
                'hotel' => '5-Star World-Class Khyber Himalayan Resort Gulmarg / Lalit Grand Palace',
                'transport' => 'Private Luxury Toyota Innova Crysta / Fortuner with executive chauffeur',
                'meals' => 'Full Board (All meals: Royal Wazwan, gourmet Kashmiri dining & fine cuisine)',
                'guide' => 'Senior Private VIP Historian & Personal Concierge 24/7',
                'features' => [
                    '5-Star luxury suite with heated indoor glass pool overlooking snow mountains',
                    'VIP Skip-the-line Gondola Phase 1 & Phase 2 passes to summit snowfields',
                    'Private luxury Shikara with cushions, carpets, and live Kashmiri musical tea',
                    'Private snowmobile or ATV ride session included in Gulmarg',
                    'Dedicated 24/7 private travel butler and luggage porter',
                    'VIP airport meet, greet & priority terminal escort'
                ],
                'inclusions' => [
                    '5 Nights ultra-luxury 5-star mountain suites',
                    'Full board: all breakfasts, 3-course lunches & royal Wazwan dinners',
                    'Private Toyota Innova Crysta at full disposal throughout',
                    'Gondola Phase 1 & 2 tickets + snowmobile safari',
                    'Unlimited Kahwa tea and dry fruit welcome hamper',
                    'All monument, park permits and sanctuary entry fees'
                ],
                'exclusions' => [
                    'Air tickets (can be arranged on request)'
                ]
            ]
        ],
        'itinerary' => [
            ['day' => 1, 'title' => 'Arrival in Srinagar & Sunset Shikara Ride', 'desc' => 'Warm traditional greeting at Srinagar Airport with saffron Kahwa. Check into heritage houseboat on Dal Lake. Enjoy an evening Shikara cruise admiring Char Chinar and floating gardens.'],
            ['day' => 2, 'title' => 'Mughal Gardens & Old Srinagar Bazaar', 'desc' => 'Visit Nishat Bagh (Garden of Bliss), Shalimar Bagh, and Chashme Shahi built by Emperor Jahangir. Afternoon stroll through the vibrant Jamia Masjid and Lal Chowk markets.'],
            ['day' => 3, 'title' => 'Srinagar to Gulmarg (Meadow of Flowers)', 'desc' => 'Drive through scenic willow and poplar trees to Gulmarg. Board the world-famous Gondola cable car soaring over pine-covered peaks up to Apharwat summit snowfields.'],
            ['day' => 4, 'title' => 'Gulmarg to Pahalgam (Valley of Shepherds)', 'desc' => 'Drive to picturesque Pahalgam via saffron fields of Pampore and historical Avantipur ruins. Walk along the crystal clear Lidder River surrounded by fir-covered hills.'],
            ['day' => 5, 'title' => 'Betaab Valley & Aru Valley Exploration', 'desc' => 'Excursion to the legendary Betaab Valley (named after the Bollywood classic) and peaceful Aru Valley. Enjoy campfire and authentic Kashmiri Rogan Josh dinner.'],
            ['day' => 6, 'title' => 'Souvenir Shopping & Departure', 'desc' => 'Shop for world-renowned Kashmiri saffron, walnuts, and handwoven Pashmina shawls before executive transfer to Srinagar International Airport.']
        ]
    ],
    [
        'id' => 'goa-bliss',
        'title' => 'Goa Coastal Bliss: Beaches, Cruises & Nightlife',
        'tagline' => 'Golden sandy beaches, Portuguese architecture, water sports & sunset cruises',
        'country' => 'India',
        'location' => 'Goa (North Goa & South Goa)',
        'category' => 'Beach & Coastal',
        'rating' => 4.90,
        'reviews_count' => 388,
        'duration' => '5 Days / 4 Nights',
        'group_size' => '2 - 10 Travelers',
        'best_season' => 'October to May',
        'badge' => 'Bestseller Holiday',
        'featured' => true,
        'hero_image' => 'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?auto=format&fit=crop&w=1200&q=80',
        'gallery' => [
            'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1587922546307-776227941871?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=800&q=80'
        ],
        'overview' => 'Unwind in India’s sunshine state! From buzzing beach shacks, lively night markets, and thrilling water sports in North Goa, to tranquil white-sand stretches, centuries-old Portuguese churches of Old Goa, and luxury river cruises in South Goa.',
        'highlights' => [
            'Sunset Catamaran cruise along Mandovi River with Goan folk music',
            'Water sports package (Parasailing, Jet Ski & Banana ride at Calangute/Baga)',
            'Visit UNESCO World Heritage Basilica of Bom Jesus and Se Cathedral',
            'Scenic jungle jeep safari to majestic Dudhsagar Waterfalls',
            'Authentic Goan prawn curry, fish thali & beachside candlelit dining'
        ],
        'plans' => [
            'explorer' => [
                'name' => 'Explorer Plan',
                'type' => 'Youth & Friends Beach Break',
                'price' => 12999,
                'discount_price' => 9999,
                'badge' => 'Budget Friendly',
                'hotel' => '3-Star Modern Resort with Swimming Pool near Calangute / Baga Beach',
                'transport' => 'Airport Transfers + Self-Drive Scooter / Shared AC Coach for day tour',
                'meals' => 'Daily buffet breakfast + 1 Welcome Goan dinner',
                'guide' => 'Local destination coordinator & digital party guide',
                'features' => [
                    '3-star vibrant hotel within walking distance to famous beaches',
                    'Daily continental & Indian breakfast included',
                    'Both way airport/railway station pick-up and drop-off',
                    'Full day North Goa beach and fort sightseeing tour',
                    'Free Wi-Fi and 24/7 travel helpline'
                ],
                'inclusions' => [
                    '4 Nights stay in 3-star selected pool resort',
                    'Daily breakfast',
                    'Airport pickup and drop-off',
                    'North Goa sightseeing transfer'
                ],
                'exclusions' => [
                    'Flight/Train tickets to Goa',
                    'Water sports tickets & club entry fees'
                ]
            ],
            'comfort' => [
                'name' => 'Comfort Plan',
                'type' => 'Most Popular / Premium Couple & Family',
                'price' => 22999,
                'discount_price' => 18499,
                'badge' => 'Most Popular',
                'hotel' => '4-Star Beachfront Luxury Resort with Private Beach Access (Candolim / Cavelossim)',
                'transport' => 'Private AC Vehicle with dedicated chauffeur for all 5 days',
                'meals' => 'Daily luxury breakfast + 2 Goan seafood specialty dinners',
                'guide' => 'Private local guide for Old Goa heritage walk',
                'features' => [
                    '4-star beachfront resort with tropical gardens & swim-up bar',
                    'Private AC Sedan at your service for sightseeing and shopping',
                    '2-Hour Sunset luxury river cruise on Mandovi River with drinks & DJ',
                    '5-in-1 Water sports combo ticket (Parasailing, Jet Ski, Bumper, Banana, Speedboat)',
                    'Romantic beachside candlelit seafood banquet with wine'
                ],
                'inclusions' => [
                    '4 Nights in 4-star beachfront luxury resort',
                    'Daily breakfast + 2 multi-course dinners',
                    'Private car with driver for all 5 days',
                    'Water sports combo pass included',
                    'Sunset boat cruise tickets'
                ],
                'exclusions' => [
                    'Airfare to Goa',
                    'Casino chips'
                ]
            ],
            'luxury' => [
                'name' => 'Royal Maharaja VIP Plan',
                'type' => '5-Star Luxury Ocean Villa & Yacht Charter',
                'price' => 48999,
                'discount_price' => 39999,
                'badge' => 'VIP Luxury',
                'hotel' => '5-Star Ultra-Luxury Taj Exotica Resort & Spa / W Goa Private Sea Villa',
                'transport' => 'Private Mercedes-Benz / Audi Luxury Chauffeur throughout',
                'meals' => 'Full Board: Gourmet dining, beach cabana feasts & premium drinks',
                'guide' => 'Private Goa Lifestyle Ambassador & VIP Concierge',
                'features' => [
                    'Iconic 5-star private sea-facing plunge pool villa',
                    'Exclusive 3-hour private luxury yacht charter cruising the Arabian Sea',
                    'VIP entry passes to top luxury offshore casinos (Deltin Royale / Big Daddy)',
                    'Couples luxury Ayurvedic aromatherapy spa massage',
                    'Private barbecue feast cooked by personal chef on private beach',
                    'VIP airport tarmac lounge & private luxury limousine transfer'
                ],
                'inclusions' => [
                    '4 Nights in world-class 5-star beachfront villas',
                    'Full board dining with chef curated seafood & international menus',
                    'Private Mercedes/Audi with dedicated executive chauffeur',
                    'Private luxury motor yacht charter for your group',
                    'Unlimited luxury spa therapy sessions',
                    '24/7 personal butler service'
                ],
                'exclusions' => [
                    'Flight tickets'
                ]
            ]
        ],
        'itinerary' => [
            ['day' => 1, 'title' => 'Arrival & Sunset Beach Vibes', 'desc' => 'Warm welcome at Goa Dabolim/MOPA Airport. Private transfer to your resort. Relax on the golden sands and enjoy evening sundowner drinks with live acoustic music.'],
            ['day' => 2, 'title' => 'North Goa Forts & Water Sports', 'desc' => 'Explore the 17th-century Portuguese Aguada Fort and lighthouse. Head to Baga beach for thrilling water sports: parasailing with ocean dip, jet skiing, and banana boat rides.'],
            ['day' => 3, 'title' => 'Old Goa Heritage & Mandovi River Cruise', 'desc' => 'Discover the rich history of Old Goa at Basilica of Bom Jesus and Se Cathedral. Stroll colorful Latin Quarter of Fontainhas. In the evening, board a luxury sunset river cruise with Goan dance and music.'],
            ['day' => 4, 'title' => 'Dudhsagar Waterfalls & Spice Plantation', 'desc' => 'Thrilling 4x4 open-jeep safari through Bhagwan Mahavir Wildlife Sanctuary to the cascading 4-tiered Dudhsagar Waterfalls. Traditional Goan buffet lunch at an organic spice plantation with elephant bath.'],
            ['day' => 5, 'title' => 'Flea Market & Farewell Goa', 'desc' => 'Morning souvenir shopping at Anjuna flea market for cashews, feni, and handicrafts before scheduled executive transfer to the airport.']
        ]
    ],
    [
        'id' => 'kerala-backwaters',
        'title' => 'Kerala Backwaters & Munnar Tea Hills',
        'tagline' => 'Misty tea plantations, tranquil backwater houseboats & Ayurvedic wellness',
        'country' => 'India',
        'location' => 'Kerala (Kochi, Munnar, Thekkady & Alleppey)',
        'category' => 'Backwaters & Hills',
        'rating' => 4.96,
        'reviews_count' => 445,
        'duration' => '6 Days / 5 Nights',
        'group_size' => '2 - 10 Travelers',
        'best_season' => 'September to May',
        'badge' => 'God\'s Own Country',
        'featured' => true,
        'hero_image' => 'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&w=1200&q=80',
        'gallery' => [
            'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1593693397690-362cb9666fc2?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=800&q=80'
        ],
        'overview' => 'Breathe in the tranquility of Kerala, "God\'s Own Country". Wind through emerald tea gardens in Munnar, encounter wild elephants in Periyar Thekkady, sail through palm-fringed backwaters aboard an authentic Kettuvallam houseboat, and rejuvenate with ancient Ayurvedic therapies.',
        'highlights' => [
            'Overnight luxury stay in a traditional Alleppey AC Houseboat with private chef',
            'Munnar tea plantation trek, Mattupetty dam & Tata Tea Museum visit',
            'Periyar National Park jungle boat safari to spot wild elephants',
            'Live Kathakali dance and Kalaripayattu martial arts cultural show',
            'Traditional Kerala Sadhya feast served on banana leaf'
        ],
        'plans' => [
            'explorer' => [
                'name' => 'Explorer Plan',
                'type' => 'Scenic Nature & Backwaters',
                'price' => 16499,
                'discount_price' => 13499,
                'badge' => 'Best Value',
                'hotel' => '3-Star Plantation View Resort in Munnar & Deluxe Alleppey Houseboat',
                'transport' => 'Air-conditioned tourist vehicle with experienced Kerala chauffeur',
                'meals' => 'Daily South Indian breakfast + Full Board meals on the houseboat',
                'guide' => 'Local English/Hindi speaking destination guide',
                'features' => [
                    'Charming 3-star hill resort with tea garden views',
                    'Traditional Alleppey houseboat cruise through backwater canals',
                    'Visit Cheeyappara & Valara cascading waterfalls on Munnar highway',
                    'Spice plantation guided walk with cardamom & pepper tasting',
                    'All intercity transfers from Kochi Airport'
                ],
                'inclusions' => [
                    '5 Nights accommodation (4 nights hotel + 1 night houseboat)',
                    'Daily breakfast + all meals on houseboat day',
                    'Kochi airport pickup and drop-off',
                    'All toll, fuel, and driver allowances'
                ],
                'exclusions' => [
                    'Flight/train tickets to Kochi',
                    'Ayurvedic massage treatments'
                ]
            ],
            'comfort' => [
                'name' => 'Comfort Plan',
                'type' => 'Most Popular / Premium Ayurvedic & Houseboat',
                'price' => 26999,
                'discount_price' => 22999,
                'badge' => 'Most Popular',
                'hotel' => '4-Star Mountain Mist Resort Munnar + Private Luxury Glass Houseboat',
                'transport' => 'Dedicated Private AC Sedan (Etios / Dzire) with private chauffeur',
                'meals' => 'Daily gourmet breakfast + Full Board traditional Kerala meals on houseboat',
                'guide' => 'Private cultural & nature specialist',
                'features' => [
                    '4-star superior valley resort with private balcony overlooking clouds',
                    'Exclusive private AC houseboat with dedicated chef, captain & crew',
                    'Authentic 60-minute Ayurvedic Abhyanga herbal oil massage session',
                    'VIP seating for Kathakali & Kalaripayattu cultural performance',
                    'Periyar tiger reserve boat cruise tickets included'
                ],
                'inclusions' => [
                    '5 Nights in 4-star handpicked resorts & private luxury houseboat',
                    'Daily breakfast + all houseboat meals + 2 Kerala dinners',
                    'Private car with dedicated chauffeur for all 6 days',
                    'Ayurvedic herbal massage voucher for each adult',
                    'Cultural show and Periyar boat tickets'
                ],
                'exclusions' => [
                    'Airfare to Kochi'
                ]
            ],
            'luxury' => [
                'name' => 'Royal Maharaja VIP Plan',
                'type' => '5-Star Lake Palace & Presidential Houseboat',
                'price' => 54999,
                'discount_price' => 44999,
                'badge' => 'VIP Wellness',
                'hotel' => '5-Star Kumarakom Lake Resort / Taj Green Cove / Fragrant Nature',
                'transport' => 'Private Luxury Toyota Innova Crysta with executive chauffeur',
                'meals' => 'Full Board: Gourmet Kerala coastal delicacies, lobster & organic cuisine',
                'guide' => 'Personal Ayurvedic Doctor & Private Travel Butler',
                'features' => [
                    'Heritage 5-star villa with private plunge pool and Meandering Pool access',
                    'Ultra-luxury presidential Kettuvallam houseboat with upper deck jacuzzi',
                    'Personal Ayurvedic doctor wellness consultation & daily customized therapies',
                    'Private evening speed boat cruise along Vembanad Lake at sunset',
                    'Exclusive visit to traditional spice masters and organic tea estates',
                    'VIP airport fast-track meet & greet at Kochi International'
                ],
                'inclusions' => [
                    '5 Nights in Kerala\'s premier 5-star luxury resorts & presidential houseboat',
                    'Full board dining with private chef prepared multi-course banquets',
                    'Private luxury Innova Crysta at unlimited disposal',
                    'Daily Ayurvedic wellness therapies',
                    'Speedboat private lake tour',
                    '24/7 personal butler service'
                ],
                'exclusions' => [
                    'Air tickets'
                ]
            ]
        ],
        'itinerary' => [
            ['day' => 1, 'title' => 'Kochi Arrival & Scenic Drive to Munnar', 'desc' => 'Arrive at Cochin International Airport. Scenic winding drive through misty Western Ghats past Cheeyappara and Valara waterfalls. Check into your mountain resort in Munnar.'],
            ['day' => 2, 'title' => 'Munnar Tea Gardens & Eravikulam National Park', 'desc' => 'Explore the rolling carpets of green tea estates. Visit Eravikulam National Park (home to the endangered Nilgiri Tahr mountain goat) and sample fresh brew at Tata Tea Museum.'],
            ['day' => 3, 'title' => 'Munnar to Thekkady Spice Plantations', 'desc' => 'Drive to Thekkady. Walk through lush spice gardens smelling fresh cinnamon, cloves, and vanilla. In the evening, watch an exhilarating Kalaripayattu martial arts show.'],
            ['day' => 4, 'title' => 'Thekkady to Alleppey Houseboat Cruise', 'desc' => 'Descend to Alleppey backwaters. Board your traditional thatched-roof Kettuvallam houseboat. Cruise through peaceful lagoons, paddy fields, and village canals while fresh Karimeen fish fry is cooked for you.'],
            ['day' => 5, 'title' => 'Alleppey to Historic Fort Kochi', 'desc' => 'Disembark houseboat after breakfast. Drive to Fort Kochi. Walk past iconic Chinese Fishing Nets, St. Francis Church, Jewish Synagogue, and colonial Portuguese streets.'],
            ['day' => 6, 'title' => 'Kerala Souvenirs & Departure', 'desc' => 'Shop for organic Kerala spices, banana chips, and handicrafts before seamless executive transfer to Cochin International Airport.']
        ]
    ],
    [
        'id' => 'rajasthan-royalty',
        'title' => 'Royal Rajasthan: Jaipur, Jodhpur, Udaipur & Thar Desert',
        'tagline' => 'Majestic hill forts, glittering lake palaces & desert dunes under starlit skies',
        'country' => 'India',
        'location' => 'Rajasthan (Jaipur, Jodhpur, Udaipur & Jaisalmer)',
        'category' => 'Royal Heritage',
        'rating' => 4.98,
        'reviews_count' => 512,
        'duration' => '7 Days / 6 Nights',
        'group_size' => '2 - 12 Travelers',
        'best_season' => 'October to March',
        'badge' => 'Grand Heritage',
        'featured' => false,
        'hero_image' => 'https://images.unsplash.com/photo-1477587458883-47145ed94245?auto=format&fit=crop&w=1200&q=80',
        'gallery' => [
            'https://images.unsplash.com/photo-1477587458883-47145ed94245?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1599661046289-e31897846e41?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1587474260584-136574528ed5?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1524492412937-b28074a5d7da?auto=format&fit=crop&w=800&q=80'
        ],
        'overview' => 'Step into the legendary era of Maharajas and royal valour. Marvel at the Pink City of Jaipur with its magnificent Amber Fort, cruise the calm waters of Lake Pichola in the White City of Udaipur, admire the Blue City of Jodhpur from Mehrangarh Fort, and sleep under desert stars in Thar Desert Jaisalmer.',
        'highlights' => [
            'Amber Fort royal elephant / jeep ascent & Hawa Mahal photo stop',
            'Sunset boat cruise on Lake Pichola with views of Jag Mandir Palace',
            'Thar Desert camel safari and luxury Swiss tent stay with Kalbeliya folk dance',
            'Explore the impregnable Mehrangarh Fort and Umaid Bhawan Palace in Jodhpur',
            'Grand Rajasthani royal feast with Dal Baati Churma and Laal Maas'
        ],
        'plans' => [
            'explorer' => [
                'name' => 'Explorer Plan',
                'type' => 'Heritage Haveli & Desert Camp',
                'price' => 19999,
                'discount_price' => 16999,
                'badge' => 'Best Value',
                'hotel' => '3-Star Traditional Heritage Haveli in Jaipur & Udaipur + Swiss Desert Camp',
                'transport' => 'Air-conditioned tourist vehicle with experienced Rajasthan chauffeur',
                'meals' => 'Daily royal buffet breakfast + 1 Desert campfire dinner with folk music',
                'guide' => 'Licensed local guide for forts in Jaipur and Udaipur',
                'features' => [
                    'Charming authentic Rajput architecture haveli stay with courtyards',
                    'Thar desert camel ride and evening bonfire with folk singers',
                    'Guided walking tour of Jaipur City Palace and Jantar Mantar',
                    'Boat ride ticket on Lake Pichola in Udaipur',
                    '24/7 dedicated trip support'
                ],
                'inclusions' => [
                    '6 Nights accommodation (5 nights heritage havelis + 1 night desert camp)',
                    'Daily fresh breakfast',
                    'Jaipur airport pick-up & Udaipur drop-off',
                    'Camel safari and desert cultural show'
                ],
                'exclusions' => [
                    'Train/airfare to Rajasthan',
                    'Monument camera fees'
                ]
            ],
            'comfort' => [
                'name' => 'Comfort Plan',
                'type' => 'Most Popular / 4-Star Royal Haveli & Luxury Desert Resort',
                'price' => 34999,
                'discount_price' => 28999,
                'badge' => 'Most Popular',
                'hotel' => '4-Star Royal Heritage Haveli with Swimming Pool + Luxury AC Swiss Desert Tent',
                'transport' => 'Dedicated Private AC Toyota Innova with experienced royal chauffeur',
                'meals' => 'Daily buffet breakfast + 3 Royal Rajasthani dinners with cultural performance',
                'guide' => 'Private English/Hindi speaking historian for all fort visits',
                'features' => [
                    '4-star historic haveli hotel with ornate frescoes, chandeliers & royal courtyards',
                    'Private AC Innova throughout the circuit with no extra km charges',
                    'Thar desert 4x4 dune bashing + camel ride + luxury Swiss camp dinner show',
                    'Private decorated boat ride on Lake Pichola overlooking City Palace',
                    'Royal traditional Rajasthani dinner banquet with Dal Baati Churma & live sitar'
                ],
                'inclusions' => [
                    '6 Nights in 4-star heritage palaces & luxury desert tents',
                    'Daily royal breakfast + 3 authentic royal dinners',
                    'Private Toyota Innova for all 7 days',
                    'Lake Pichola private boat cruise',
                    'All monument and palace entry passes'
                ],
                'exclusions' => [
                    'Airfare to Jaipur'
                ]
            ],
            'luxury' => [
                'name' => 'Royal Maharaja VIP Plan',
                'type' => 'Iconic 5-Star Palaces (Taj Lake Palace / Rambagh Palace)',
                'price' => 74999,
                'discount_price' => 59999,
                'badge' => 'Living Like A King',
                'hotel' => '5-Star Palaces: Rambagh Palace Jaipur / Taj Lake Palace Udaipur / Umaid Bhawan',
                'transport' => 'Private Luxury Mercedes-Benz / BMW Chauffeur + Vintage Car ride',
                'meals' => 'Full Board: Multi-course royal feast dining with private palace butler',
                'guide' => 'Senior Royal Historian & Personal Tour Escort',
                'features' => [
                    'Sleep in genuine historical palace suites inhabited by actual Maharajas',
                    'Sunrise hot air balloon flight soaring above the ancient forts of Jaipur',
                    'Private vintage royal car ride through the illuminated streets of the Pink City',
                    'Private royal candlelit dining on a private pontoon on Lake Pichola',
                    'VIP Darshan at Govind Dev Ji Temple with priority royal protocol',
                    '24/7 Dedicated private butler and personal shopping curator'
                ],
                'inclusions' => [
                    '6 Nights in India\'s most legendary 5-star palace hotels',
                    'Full board dining with Michelin-trained chefs and royal palace recipes',
                    'Private Mercedes/BMW chauffeur with uniformed royal driver',
                    'Hot air balloon flight over Jaipur',
                    'Private Lake Pichola royal pontoon dining',
                    'VIP airport meet, greet & executive tarmac escort'
                ],
                'exclusions' => [
                    'Airfare'
                ]
            ]
        ],
        'itinerary' => [
            ['day' => 1, 'title' => 'Welcome to Pink City Jaipur', 'desc' => 'Royal welcome at Jaipur Airport with Marigold garlands and Shehnai music. Check into heritage palace. Evening visit to Birla Temple and Chokhi Dhani ethnic village.'],
            ['day' => 2, 'title' => 'Jaipur Forts & Royal Palaces', 'desc' => 'Ascend to the hilltop Amber Fort overlooking Maota Lake. Stop for photos at the Palace of Winds (Hawa Mahal), explore City Palace museum and ancient astronomical observatory Jantar Mantar.'],
            ['day' => 3, 'title' => 'Jaipur to Blue City Jodhpur', 'desc' => 'Drive through the rugged Aravalli hills to Jodhpur. Visit the grand Umaid Bhawan Palace and wander the labyrinthine cobalt-blue lanes of the old city beneath the fortress.'],
            ['day' => 4, 'title' => 'Mehrangarh Fort to Jaisalmer Desert', 'desc' => 'Explore the imposing Mehrangarh Fort. Drive westward to Jaisalmer "The Golden City". Check into luxury desert Swiss tents in Sam Sand Dunes. Enjoy camel ride at sunset followed by Rajasthani folk dance and buffet.'],
            ['day' => 5, 'title' => 'Jaisalmer Fort to Udaipur (City of Lakes)', 'desc' => 'Walk through the living golden Jaisalmer Fort and intricately carved Patwon ki Haveli. Journey south to romantic Udaipur. Check into your lakefront palace.'],
            ['day' => 6, 'title' => 'Udaipur City Palace & Lake Pichola', 'desc' => 'Tour Rajasthan\'s largest palace complex, Udaipur City Palace. Visit Sahelion-ki-Bari (Garden of Maids). In the evening, cruise on Lake Pichola watching the white marble palaces glow in sunset amber.'],
            ['day' => 7, 'title' => 'Royal Handicrafts & Departure', 'desc' => 'Shop for authentic Rajasthani textiles, blue pottery, and silver jewelry before seamless transfer to Udaipur Maharana Pratap Airport.']
        ]
    ],
    [
        'id' => 'himachal-peaks',
        'title' => 'Himachal Wonderland: Shimla, Manali & Solang Valley',
        'tagline' => 'Snow-clad peaks, pine forests, Atal Tunnel & thrilling Himalayan adventures',
        'country' => 'India',
        'location' => 'Himachal Pradesh (Shimla, Kufri, Manali & Solang Valley)',
        'category' => 'Himalayas & Snow',
        'rating' => 4.93,
        'reviews_count' => 395,
        'duration' => '6 Days / 5 Nights',
        'group_size' => '2 - 12 Travelers',
        'best_season' => 'Year-round (Summer escape / Winter snow)',
        'badge' => 'Mountain Magic',
        'featured' => false,
        'hero_image' => 'https://images.unsplash.com/photo-1581793745862-99fde7fa73d2?auto=format&fit=crop&w=1200&q=80',
        'gallery' => [
            'https://images.unsplash.com/photo-1581793745862-99fde7fa73d2?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1502784444187-359ac186c5bb?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1530122037265-a5f1f91d3b99?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1571401835393-8c5f35328320?auto=format&fit=crop&w=800&q=80'
        ],
        'overview' => 'Escape to the breathtaking majesty of the Himachal Himalayas. From the colonial British charm and toy train views of Shimla, to the roaring Beas river, pine valleys, Atal Tunnel engineering wonder, and snow adventure activities in Manali and Solang.',
        'highlights' => [
            'Drive through the world-famous Atal Tunnel into the snowy Lahaul Valley (Sissu)',
            'Snow adventure activities in Solang Valley (Paragliding, Zorbing & Quad Biking)',
            'Stroll along Shimla Mall Road, The Ridge & Christ Church',
            'Visit ancient Hadimba Devi wooden temple in Manali surrounded by cedar woods',
            'White water river rafting in the gushing Beas River at Kullu'
        ],
        'plans' => [
            'explorer' => [
                'name' => 'Explorer Plan',
                'type' => 'Youth & Friends Hill Escape',
                'price' => 14999,
                'discount_price' => 12499,
                'badge' => 'Budget Friendly',
                'hotel' => '3-Star Cozy Mountain View Hotel near Mall Road in Shimla & Manali',
                'transport' => 'Comfortable AC Sedan / Tempo Traveler with mountain experienced driver',
                'meals' => 'Daily hearty buffet breakfast + 1 Himachali welcome dinner',
                'guide' => 'Local destination coordinator for valley sightseeing',
                'features' => [
                    '3-star mountain view rooms with hot water & heating facilities',
                    'Day tour to Solang Valley snow viewpoint',
                    'Scenic drive via Pandoh Dam, Hanogi Mata Temple & Kullu Shawl factories',
                    'Shimla Kufri excursion included',
                    '24/7 dedicated customer assistance'
                ],
                'inclusions' => [
                    '5 Nights accommodation (2 nights Shimla + 3 nights Manali)',
                    'Daily fresh breakfast',
                    'Delhi/Chandigarh pick-up & drop-off',
                    'All mountain toll taxes and driver charges'
                ],
                'exclusions' => [
                    'Paragliding & adventure activity tickets',
                    'Heater charges at budget hotels (if requested extra)'
                ]
            ],
            'comfort' => [
                'name' => 'Comfort Plan',
                'type' => 'Most Popular / Premium Mountain Resort',
                'price' => 25999,
                'discount_price' => 21999,
                'badge' => 'Most Popular',
                'hotel' => '4-Star Luxury Valley Resort with Private Balcony overlooking Snow Peaks',
                'transport' => 'Dedicated Private AC Sedan (Dzire / Etios) with mountain chauffeur',
                'meals' => 'Daily gourmet breakfast + 3 multi-course dinners with bonfire',
                'guide' => 'Private local tour guide for key excursions',
                'features' => [
                    '4-star superior pine valley resort with heated rooms and wooden interiors',
                    'Dedicated private vehicle throughout your journey from Delhi/Chandigarh',
                    'Special day excursion to Atal Tunnel and snowy Sissu waterfall in Lahaul',
                    'White water river rafting ticket in Kullu included for each traveler',
                    'Evening bonfire session with hot snacks and Himachali trout/veg dinner'
                ],
                'inclusions' => [
                    '5 Nights in 4-star luxury valley resorts',
                    'Daily buffet breakfast + 3 curated dinners',
                    'Private car with mountain specialist chauffeur for all 6 days',
                    'Kullu river rafting pass',
                    'Atal Tunnel and Solang valley permit'
                ],
                'exclusions' => [
                    'Personal shopping (Kullu shawls, apples)'
                ]
            ],
            'luxury' => [
                'name' => 'Royal Maharaja VIP Plan',
                'type' => '5-Star Oberoi Wildflower Hall & Luxury SUV',
                'price' => 52999,
                'discount_price' => 42999,
                'badge' => 'Himalayan Luxury',
                'hotel' => '5-Star World-Renowned Wildflower Hall Shimla (Oberoi) & Span Resort Manali',
                'transport' => 'Private Luxury Toyota Fortuner / Innova Crysta with executive chauffeur',
                'meals' => 'Full Board: Fine dining mountain gastronomy, European & Himachali feasts',
                'guide' => 'Senior Mountain Naturalist & VIP Concierge',
                'features' => [
                    '5-Star luxury suite with heated outdoor infinity whirlpool overlooking the Himalayas',
                    'Private snowmobile / snow-scooter tour and tandem paragliding with instructor',
                    'Private guided forest pine trail trek with gourmet champagne picnic',
                    'Exclusive couples thermal spa and Himalayan cedar wood sauna session',
                    'Atal Tunnel VIP executive transit to Sissu and Chandra riverbank',
                    '24/7 personal butler service and welcome luxury dry fruit hamper'
                ],
                'inclusions' => [
                    '5 Nights in 5-star premier Himalayan resorts',
                    'Full board dining with chef curated multi-course banquets',
                    'Private luxury Fortuner / Crysta at unlimited disposal',
                    'Paragliding and snow activities pass',
                    'Spa therapy sessions included',
                    'Express airport / railway station VIP meet and transfer'
                ],
                'exclusions' => [
                    'Airfare'
                ]
            ]
        ],
        'itinerary' => [
            ['day' => 1, 'title' => 'Delhi/Chandigarh to Shimla (Queen of Hills)', 'desc' => 'Pick-up from Delhi or Chandigarh. Enjoy a scenic ascent past pine ridges and toy train tracks to Shimla. Check into your mountain resort and take an evening walk on the bustling Mall Road.'],
            ['day' => 2, 'title' => 'Shimla & Kufri Winter Wonderland', 'desc' => 'Excursion to Kufri at 2,622 meters. Enjoy horse rides through cedar forests to Mahasu Peak. Stroll through Shimla\'s iconic Christ Church and colonial heritage buildings.'],
            ['day' => 3, 'title' => 'Shimla to Manali via Kullu Valley', 'desc' => 'Scenic mountain drive along the sparkling Beas river. Stop at Pandoh Dam, explore authentic Kullu shawl weaving factories, and experience thrilling white water rafting in Kullu.'],
            ['day' => 4, 'title' => 'Solang Valley & Atal Tunnel Adventure', 'desc' => 'Drive through the marvel of engineering — Atal Tunnel (9.02 km) to Sissu in Lahaul Valley. In Solang Valley, experience paragliding soaring over alpine meadows and snowmobiling.'],
            ['day' => 5, 'title' => 'Old Manali, Hadimba Temple & Vashisht Hot Springs', 'desc' => 'Visit the 16th-century wooden Hadimba Devi Temple in deep deodar forests. Soak in natural sulfur hot springs at Vashisht village and explore bohemian cafes in Old Manali.'],
            ['day' => 6, 'title' => 'Farewell Himalayas', 'desc' => 'Relish breakfast with panoramic mountain views before comfortable executive return drive to Chandigarh or Delhi Airport/Railway Station.']
        ]
    ],
    [
        'id' => 'varanasi-ayodhya',
        'title' => 'Spiritual India: Varanasi Ganga Aarti & Ayodhya Ram Mandir',
        'tagline' => 'Sacred Ganga Ghats, divine evening Aarti, ancient temples & Ayodhya pilgrimage',
        'country' => 'India',
        'location' => 'Uttar Pradesh (Varanasi, Sarnath & Ayodhya)',
        'category' => 'Spiritual & Holy',
        'rating' => 4.97,
        'reviews_count' => 460,
        'duration' => '4 Days / 3 Nights',
        'group_size' => '2 - 12 Travelers',
        'best_season' => 'October to April',
        'badge' => 'Divine Yatra',
        'featured' => false,
        'hero_image' => 'https://images.unsplash.com/photo-1561361513-2d000a50f0dc?auto=format&fit=crop&w=1200&q=80',
        'gallery' => [
            'https://images.unsplash.com/photo-1561361513-2d000a50f0dc?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1524492412937-b28074a5d7da?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1599661046289-e31897846e41?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80'
        ],
        'overview' => 'Immerse your soul in the world\'s oldest living city. Witness the hypnotic evening Ganga Aarti ceremony with chanting bells and oil lamps at Dashashwamedh Ghat, take a sunrise boat ride on the holy river, seek blessings at the sacred Kashi Vishwanath Jyotirlinga, and embark on a divine pilgrimage to the grand Ram Janmabhoomi Mandir in Ayodhya.',
        'highlights' => [
            'VIP Boat seating for the magnificent Dashashwamedh Ghat Ganga Aarti ceremony',
            'Special VIP Darshan at Kashi Vishwanath Temple and corridor walk',
            'Day pilgrimage to Ayodhya: Grand Ram Mandir, Hanumangarhi & Saryu Ghat',
            'Visit Sarnath Deer Park where Lord Buddha delivered his first sermon',
            'Taste authentic Banarasi Kachori-Jalebi, Malaiyo & Banarasi Paan'
        ],
        'plans' => [
            'explorer' => [
                'name' => 'Explorer Plan',
                'type' => 'Spiritual Yatri / Budget Friendly',
                'price' => 10999,
                'discount_price' => 8999,
                'badge' => 'Budget Friendly',
                'hotel' => '3-Star Clean Heritage Hotel near Godowlia & Ghats in Varanasi',
                'transport' => 'Air-conditioned vehicle for Ayodhya excursion and airport transfers',
                'meals' => 'Daily pure vegetarian breakfast + 1 Traditional Banarasi Thali dinner',
                'guide' => 'Knowledgeable local priest/guide for temple and ghat history',
                'features' => [
                    'Clean and hygienic 3-star hotel within easy walking distance to ghats',
                    'Morning sunrise boat ride on holy River Ganga',
                    'Guided walking tour through ancient narrow alleys of Kashi',
                    'Day trip excursion to Ayodhya Ram Mandir included',
                    '24/7 dedicated local assistance'
                ],
                'inclusions' => [
                    '3 Nights accommodation in 3-star heritage hotel',
                    'Daily breakfast',
                    'Varanasi airport/railway station pickup and drop-off',
                    'Morning boat ride and Ayodhya transfer'
                ],
                'exclusions' => [
                    'Train/flight tickets',
                    'VIP special puja charges'
                ]
            ],
            'comfort' => [
                'name' => 'Comfort Plan',
                'type' => 'Most Popular / Premium Pilgrimage with VIP Darshan',
                'price' => 19999,
                'discount_price' => 15999,
                'badge' => 'Most Popular',
                'hotel' => '4-Star Riverfront Hotel (Radisson / Gateway / Heritage Ganga View Hotel)',
                'transport' => 'Dedicated Private AC Sedan (Etios / Dzire) with private chauffeur',
                'meals' => 'Daily buffet breakfast + 2 pure vegetarian multi-course thali dinners',
                'guide' => 'Dedicated private scholar guide and Pandit for temple rituals',
                'features' => [
                    '4-star comfort hotel with modern amenities and Ganga proximity',
                    'Private decorated Bajra wooden boat for evening Aarti ceremony with priest blessings',
                    'Assisted VIP protocol entry at Kashi Vishwanath Corridor',
                    'Ayodhya pilgrimage with visit to Ram Janmabhoomi, Hanumangarhi & Kanak Bhawan',
                    'Excursion to Sarnath with Dhamek Stupa and Archeological Museum'
                ],
                'inclusions' => [
                    '3 Nights in 4-star superior hotels',
                    'Daily breakfast + 2 special thali dinners',
                    'Private car with chauffeur for all 4 days',
                    'Private evening boat ride for Ganga Aarti',
                    'All temple facilitation and museum entry passes'
                ],
                'exclusions' => [
                    'Flight tickets'
                ]
            ],
            'luxury' => [
                'name' => 'Royal Maharaja VIP Plan',
                'type' => '5-Star Taj Nadesar Palace / BrijRama Palace on Ghat',
                'price' => 41999,
                'discount_price' => 32999,
                'badge' => 'VIP Spiritual',
                'hotel' => '5-Star BrijRama Palace (Right on Darbhanga Ghat) / Taj Nadesar Palace',
                'transport' => 'Private Luxury Toyota Innova Crysta / Mercedes with executive chauffeur',
                'meals' => 'Full Board: Gourmet pure vegetarian cuisine, Sattvic dining & royal Banarasi feasts',
                'guide' => 'Senior Cultural Historian & Personal Head Priest for Private Puja',
                'features' => [
                    'Stay in a 210-year-old historic stone palace situated directly above the Ganga waters',
                    'Exclusive private royal boat with cushions, live classical Shehnai & Sitar music',
                    'Private Rudrabhishek Puja ceremony performed by senior Vedic priests at Kashi Vishwanath',
                    'Ayodhya VIP pilgrimage with special guest access to Ram Lalla sanctum',
                    'Personal guided shopping tour to master weavers of pure gold Zari Banarasi silk sarees',
                    'VIP airport meet, greet & executive tarmac escort at Varanasi International'
                ],
                'inclusions' => [
                    '3 Nights in world-class 5-star palace suites',
                    'Full board gourmet vegetarian dining',
                    'Private luxury Innova Crysta throughout',
                    'Private Rudrabhishek Puja and sacred offerings',
                    'Private luxury musical boat charter',
                    '24/7 personal butler service'
                ],
                'exclusions' => [
                    'Flight tickets'
                ]
            ]
        ],
        'itinerary' => [
            ['day' => 1, 'title' => 'Arrival in Kashi & Divine Ganga Aarti', 'desc' => 'Warm traditional welcome at Lal Bahadur Shastri Airport. Transfer to your hotel. At twilight, witness the awe-inspiring grand Ganga Aarti ceremony from your private boat as thousands of brass lamps illuminate the sacred river.'],
            ['day' => 2, 'title' => 'Subah-e-Banaras, Kashi Vishwanath & Sarnath', 'desc' => 'Early morning sunrise boat ride past Manikarnika and Harishchandra Ghats. Seek blessings at Kashi Vishwanath Temple (Golden Temple). In the afternoon, visit Sarnath where Lord Buddha gave his first sermon.'],
            ['day' => 3, 'title' => 'Full Day Ayodhya Ram Mandir Pilgrimage', 'desc' => 'Early morning executive drive to sacred Ayodhya. Visit the magnificent newly consecrated Ram Janmabhoomi Mandir, pray at Hanumangarhi Temple, and attend evening Saryu River Aarti before returning to Varanasi.'],
            ['day' => 4, 'title' => 'Banarasi Silk Heritage & Departure', 'desc' => 'Visit traditional artisan handloom weavers creating legendary Banarasi silk sarees. Savor piping hot Kachori-Jalebi breakfast before scheduled transfer to Varanasi Airport/Railway Station.']
        ]
    ]
];

// Optional Travel Add-ons in Indian Rupees (₹)
$available_addons = [
    'insurance' => [
        'id' => 'insurance',
        'name' => 'Comprehensive Domestic Travel & Medical Insurance',
        'price' => 999,
        'desc' => '100% trip cancellation protection, emergency medical hospital hospitalization coverage, and baggage loss compensation.'
    ],
    'photo_pass' => [
        'id' => 'photo_pass',
        'name' => 'Professional Photographer Session in Traditional Attire',
        'price' => 2999,
        'desc' => '2-hour private photo shoot with local professional photographer at iconic monuments, including 30 high-res retouched digital photos.'
    ],
    'lounge_access' => [
        'id' => 'lounge_access',
        'name' => 'VIP Domestic Airport Lounge Access Passes',
        'price' => 1499,
        'desc' => 'Relax before boarding with complimentary hot buffet meals, Wi-Fi, refreshments, and comfortable lounge seating.'
    ],
    'sim_card' => [
        'id' => 'sim_card',
        'name' => 'High-Speed 4G/5G Tourist SIM / Unlimited Data',
        'price' => 499,
        'desc' => 'Instant activation prepaid 5G SIM with unlimited high-speed data and all-India calling for your entire trip.'
    ]
];

// Real Customer Testimonials for India
$testimonials = [
    [
        'name' => 'Priya & Rahul Sharma',
        'location' => 'Mumbai, Maharashtra',
        'package' => 'Kashmir Paradise (Comfort Plan)',
        'rating' => 5,
        'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80',
        'review' => 'Our Kashmir honeymoon with WanderWise India was simply magical! The Comfort Plan gave us an amazing luxury carved houseboat on Dal Lake and our own private Innova driver who was so polite. The Gulmarg Gondola Phase 2 view was unforgettable!'
    ],
    [
        'name' => 'Vikramaditya Rathore',
        'location' => 'New Delhi',
        'package' => 'Royal Rajasthan (Maharaja VIP Plan)',
        'rating' => 5,
        'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80',
        'review' => 'Living like a true king at Rambagh Palace Jaipur and Taj Lake Palace Udaipur was a once-in-a-lifetime experience. Everything from the private boat dining on Lake Pichola to the Thar desert camp was curated to royal perfection.'
    ],
    [
        'name' => 'Ananya & Karthik Iyer',
        'location' => 'Bengaluru, Karnataka',
        'package' => 'Kerala Backwaters & Munnar (Comfort Plan)',
        'rating' => 5,
        'avatar' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=200&q=80',
        'review' => 'The private Alleppey AC houseboat with our own personal chef was the best holiday we have ever had. The food cooked on board was delicious authentic Karimeen fry and Kerala Sadya. Booking in Indian Rupees with UPI was super quick!'
    ]
];
