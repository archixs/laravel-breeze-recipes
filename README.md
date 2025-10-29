# 🍽️ Recipes – Receptes ar MI atbalstu

**Recipes** ir tīmekļa vietne, kas ļauj lietotājiem pārlūkot, pievienot, rediģēt un vērtēt ēdienu receptes. Projekts izstrādāts ar **Laravel Breeze** un papildināts ar **mākslīgā intelekta** integrāciju, kas padara ēdiena gatavošanu personalizētāku un ērtāku.

## 🔧 Tehnoloģijas
- Laravel Breeze (autentifikācija un pamata struktūra)
- AI integrācija (čats ar MI)
- SQLite (datu bāze)

## 💡 Galvenās funkcijas

- **Receptes pārlūkošana** – pieejama visiem lietotājiem bez pieslēgšanās.
- **Autentifikācija** – nepieciešama, lai skatītu pilnu receptes aprakstu, pievienotu jaunas receptes un rediģētu esošās.
- **Čats ar MI** – sadaļa, kur lietotājs var aprakstīt savas vēlmes vai pieejamos produktus un saņemt piemērotu recepti.
- **Zvaigžņu vērtējumi** – lietotāji var novērtēt receptes, redzēt vidējo vērtējumu.
- **Meklēšana un kārtošana** – pēc receptes nosaukuma un kategorijām.
- **Lietotāju lomas**:
  - Parastie lietotāji: var rediģēt un dzēst tikai savas receptes.
  - Administratori: var rediģēt un dzēst visas receptes.

## 🗃️ Datubāzes struktūra (īsumā)

- `users`: lietotāju dati un lomas
- `recipes`: receptes ar nosaukumu, aprakstu, sastāvdaļām, soļiem, kategoriju, attēlu
- `categories`: receptes kategorijas (piemēram, pica, pasta, deserts)
- `ratings`: zvaigžņu vērtējumi, sasaistīti ar receptēm un lietotājiem


## 📦 Uzstādīšana

**1. Klonē repozitoriju:**
```bash
git clone https://github.com/archixs/laravel-breeze-recipes.git
cd laravel-breeze-recipes
```

**2. Instalē atkarības:**
```bash
composer install
npm install && npm run dev
```

**3. Izveido .env failu un konfigurē datu bāzi:**
```bash
cp .env.example .env
php artisan key:generate
```

**4. Migrē datu bāzi:**
```bash
php artisan migrate
```

**5. Palaid serveri:**
```bash
php artisan serve
```

## 🤖 MI funkcionalitāte

MI čats ir pieejams autentificētiem lietotājiem. Tas ļauj:
- Aprakstīt, ko vēlies pagatavot.
- Norādīt pieejamos produktus.
- Saņemt receptes, kas pielāgotas tavām vajadzībām.

## 📸 Ekrānšāviņi


**Izbaudi ēdiena gatavošanu ar MI atbalstu!**