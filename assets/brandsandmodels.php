<?php

    $cars = array("Acura", "Alfa-Romeo", "Aston_Martin", "Audi", "Bentley", "BMW", "Bugatti", "Buick", "Cadilliac", "Chevrolet", "Chrysler", "Citroen", "Dodge", "Ferrari", 
        "Fiat", "Ford", "GMC", "Honda", "Hyundai", "Infiniti", "Jaguar", "Jeep", "Kia", "Land_Rover", "Lexus", "Maserati",
        "Mazda", "Mercedes_benz", "Mini", "Mitsubishi", "Nissan", "Peugeot", "Opel", "Porsche", "Renault", "Saab", "Seat", "Skoda", "Subaru", "Suzuki",
        "Tesla", "Toyota", "Volkswagen", "Volvo");



    $models = array("Acura"=>array("ARX-01", "ARX-02a", "ZDX"), "Alfa-Romeo"=>array("Spider", "8C Competizione", "Brera", "159", "105 Series Coupe", "166", "156", "GTV6", "MiTo", 
        "145", "75", "147", "155", "GT", "Giulietta", "Kamal"), "Aston_Martin"=>array("Rapide", "DB7", "Vanquish", "DB9", "One-77"), "Audi"=>array("R8", "A4", "A6", "TT", 
        "A3", "A8", "A5", "S5", "RS4". "RS6", "Q7", "Q5", "Q3", "A1", "A2", "Allroad", "Coupe GT", "S3", "S2", "80", "90", "100", "Cabriolet", "A7"), "Bentley"=>array("Arnage", "Continental"), 
        "BMW"=>array("M3", "3 Series", "X1", "X3", "Z3", "Z4", "X6", "X5", "5 Series", "M5", "1 Series", "M6", "7 Series", "6 Series", "8 Series"), "Bugatti"=>array("Veyron"), 
        "Buick"=>array("Rainier", "Regal", "LaCrosse"), "Cadilliac"=>array("Escalade", "CTS", "CTS-V", "SRX", "STS-V", "XLR"), "Chevrolet"=>array("Camaro", "Tahoe", "Silverado", 
        "Corvette", "Malibu", "Omega"), "Chrysler"=>array("300M", "300C", "Concorde", "PT Cruiser", "stratus", "Town and Country", "Voyager/Grand Voyager"), "Citroen"=>array("Berlingo", 
        "C-Crosser", "C-Elysee", "C1", "C2", "C3", "C3 Picaso", "C4", "C4 Picaso", "C5", "C5 Tourer", "C6", "C8", "DS", "Evasion", "Jumper", "Jumpy", "Nemo", "Xantia", "XM", "Xsara", 
        "Xsara Picaso"), "Dodge"=>array("Viper"), "Ferrari"=>array("360"),"Fiat"=>array("Multipla", "Uno", "Panda", "500", "Punto", " Fiorino", "Ducato", "Albea", "Idea", "Coupé", "Hydrogen", 
        "6 HP", "Scudo"), "Ford"=>array("Fiesta", "Pinto", "Focus", "Explorer", "Taurus", "Ranger", "Mondeo", "Mustang", "S-Max", "Galaxy", "Transit Custom", "Transit"), "GMC"=>array("Yukon"), 
        "Honda"=>array("Accord", "Civic ", "CR-V", "Odyssey", "Civic Type R", "Prelude", "NSX", "FR-V", "Legend", "Concerto", "HR-V", "Avancier", " CR-X", "CR-X"), "Hyundai"=>array("Tucson", 
        "Genesis Coupe", "Getz", "Terracan", "i20", "Santamo", "i30"), "Infiniti"=>array("QX50", "QX70", "QX80"), "Jaguar"=>array("XJ", "X-Type", "S-Type"), "Jeep"=>array("Cherokee", "Wrangler", 
        "Patriot", "Commander", " Cherokee (XJ)"), "Kia"=>array("Carnival", "Cee'd", "Mentor", "Picanto", "Sorento", "Sportage"), "Land_Rover"=>array("Evoque", "Range Rover", "Discovery",
        "Classic", "Range Rover Sport", "Freelander", "Defender"), "Lexus"=>array("CT", "IS", "ES", "GS", "LS", "SC", "LFA", "RX", "GX", "RX Hybrid", "IS (XE20)"), "Maserati"=>array("Spyder"), 
        "Mazda"=>array("MX-5", "MX-3", "RX-8", "Mazda3", "Mazda2", "BT-50", "CX-3", "CX-5", "CX-7", "CX-9", "121", "323", "626", "Demio", "E 2200", "Mazda2", "Mazda3", "Mazda5", "Mazda6",
        "Millenia", "MPV", "Premacy", "Tribute"), "Mercedes_benz"=>array("A-Class", "B-Class", "C-Class", "CL-Class", "CLA-Class", "CLK-Class", "CLS-Class", "E-Class", "G-Class", "GL-Class", 
        "GLA-Class", "GLC-Class", "GLE-Class", "GLK-Class", "ML-Class", "R-Class", "S-Class", "SL-Class", "SLK-Class", "V-Class", "Mercedes-bendz", "Sprinter", "Vaneo", "Viano", "Vito"),
        "Mini"=>array("1300", "Clubman", "Cooper", "Cooper S", "One"), "Mitsubishi"=>array("3000 GT", "Asx", "Canter", "Carisma", "Colt", "Eclipse", "Galant", "Grandis", "L 200", "L 300",
        "Lancer", "Lancer Evolution", "Montero Sport", "Outlander", "Pajero", "Pajero Pinin", "Space Gear", "Space Runner", "Space Star", "Space Wagon"), "Nissan"=>array("100 NX", "200 SX", "350 Z",
        "Almera", "Almera Tino", "Cube", "King Cab", "Kubistar", "Maxima", "Micra", "Murano", "Navara", "Note", "NP300", "NV200", "Pathfinder", "Patrol", "Pick Up", "Primastar", "Primera", 
        "Pulsar", "Qashqai", "Skyline", "Sunny", "Terrano", "Terrano I", "Terrano II", "Tiida", "Urvan", "Vanette", "X-Terra", "X-Trail"), "Pegeot"=>array("206", "1007", "407", "207", "4007", "Partner",
        "307", "106", "Expert", "405", "306" , "406", " 605", "607", "308", "608"), "Opel"=>array("Adam", "Agila", "Ampera", "Antara", "Ascona", "Astra", "Astra Van", "Calibra", "Combo",
        "Corsa", "Corsa Van", "Frontera", "Frontera Sport", "Insignia", "Kadet", "Meriva", "Mokka", "Monterey", "Movano", "Omega", "Rekord", "Signium", "Sintra", "Tigra", "Vectra", "Vectra-A", 
        "Vivaro", "Zafira"), "Porsche"=>array("911", "924", "944", "Boxster", "Panamera", "Macan"), "Renault"=>array("11", "19", "5", "Captur", "Clio", "Espace", "Grand Espace", "Grand Scenic", 
        "Kangoo", "Koleos", "Laguna", "Mascott", "Master", "Megane", "Modus", "Safrane", "Scenic", "Trafic", "Twingo", "VEL Satis"), "Saab"=>array("9-5", "0-3", "900", "9000", "95", "99"), 
        "Seat"=>array("Alhambra", "Altea", "Arosa", "Cordoba", "Ibiza", "Inca", "Leon", "Toledo"), "Skoda"=>array("Citigo", "Fabio", "Felecia", "Octavia", "Praktik", "Rapid", "Roomster",
        "Superb", "Yeti"), "Subaru"=>array("B9 Tribeca", "Brz", "Forester", "Impreza", "Legacy", "Levorg", "Libero", "Outback", "XV"), "Suzuki"=>array("Alto", "Beleno", "Carry", "Grand Vitara",
        "Ignis", "Jimny", "Liana", "Samurai", "Swift", "SX-4", "Vitara"), "Toyota"=>array("4-Runner", "Auris", "Avalon", "Avensis", "Avensis Verso", "Aygo", "Camry", "Carina E", "Carina-2",
        "Celina", "Corolla", "Corolla Coupe", "Corolla Verso", "Corolla Verso II", "Hi-Lux", "Hiace", "Hilux", "IQ", "Land Cruiser", "Liteace", "MR2", "Paseo", "Picnic", "Previa", "Prius",
        "Proace", "RAV 4", "Sienna", "Supra", "Tundra", "Venza", "Verso", "Verso-S", "Yaris"), "Volkswagen"=>array("Amarok", "Beetle", "Caddy", "Caravelle", "Corrado", "Crafter", "Eos", "Fox", "Golf-1",
        "Golf-2", "Golf-3", "Golf-4", "Golf-5", "Golf-6", "Golf-7", "Plus", "Sportsvan", "Variant", "Iltis", "Jetta", "Kaefer", "LT", "Lupo", "Multivan", "Passat B2", "Passat B3", "Passat B4", 
        "Passat B5", "Passat B6", "Passat B7", "Passat B8", "Passat Alltrack", "Passat CC", "Phaeton", "Polo", "Sciroco", "Sharan", "T2", "T3", "T4". "T5", "T6", "Taro", "Tiguan", "Toureg", 
        "Touran", "Transporter", "Up!", "Vento"), "Volvo"=>array("240", "244", "344", "360", "440", "66", "740", "850", "940", "960", "C30", "C70", "S40", "S60", "S70", "S80", "S90", "V40", 
        "V50", "V60", "V70", "V90", "XC 60", "XC 70", "XC 90"));

?>
