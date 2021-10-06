<?php

use App\Product;

class ProductsTableSeeder extends DictionariesTableSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $obj[1] = Product::create([
            'created_by' => 2,
            'category_id' => 1,
            'is_special' => 1,
            'place_id' => 4
        ]);
        $obj[2] = Product::create([
            'created_by' => 2,
            'category_id' => 4
        ]);
        $obj[3] = Product::create([
            'created_by' => 2,
            'category_id' => 4
        ]);
        $obj[4] = Product::create([
            'created_by' => 2,
            'category_id' => 3,
            'is_special' => 1,
            'place_id' => 4
        ]);
        $obj[5] = Product::create([
            'created_by' => 2,
            'category_id' => 3,
            'is_special' => 1,
            'place_id' => 4
        ]);
        $obj[6] = Product::create([
            'created_by' => 2,
            'category_id' => 2,
            'place_id' => 4
        ]);

        # Dictionary
        $this->create($obj[1], [
            'title' => [
                'fa' => 'آجر',
                'en' => 'Brick',
                'tr' => 'Tuğla'
            ],
            'description' => [
                'fa' => 'آجُر به خشت‌هایی گفته می‌شود که احکام یا فرامین دولتی بر روی آن نوشته می‌شد (حک می‌گردید) و به وسیله پختن این خشت‌ها(آجر نوعی خشت به حساب می‌آید اما خشت با استفاده از گل و کاه ساخته شده‌است)، نوشته‌ها را بر روی آن پایدار می‌کردند. مشخص نیست که آجر برای اولین بار از چه زمانی مورد استفاده قرار گرفته‌است؛ گمان می‌رود انسان‌های اولیه با مشاهده پخته شدن گل مجاور اجاق‌های خود و دیدن اینکه گل پخته شده سختتر از کلوخه‌های کنار خود می‌گردید پی به خواص و روش تهیه آجر برده باشند. آجر همچنین به عنوان یکی از مصالح ساختمانی از دیرباز مورد استفاده بوده‌است. مصرف آجر به عنوان مصالح ساختمانی در ایران سابقه باستانی دارد. از بناهای باستانی مشهوری که در ساخت آن از آجر استفاده شده می‌توان به طاق کسری اشاره کرد. مثال دیگر کف دالان مسجد جامع اصفهان است که به وسیله آجرهایی مفروش شده‌است که در زمان ساسانیان برای ساخت آتشکده بکار رفته بود. به‌طور کلی استفاده از آجر در طول تاریخ ایران بسیار گسترده بوده و بناهای بیشماری اعم از آتشکده، مسجد، ساختمان‌های مسکونی و… به وسیله آجر در ایران ساخته شده‌اند. در حال حاضر با توجه به بالا رفتن تراکم جمعیت و ساخت بناهای چندین طبقه استفاده از آجر در اسکلت این نوع ساختمان‌ها مقدور نیست و از اسکلت‌های فلزی یا بتنی استفاده می‌شود؛ ولی از آجر برای نماسازی استفاده می‌شود یا در قسمتی از سالن و سایر فضاها آجر را به‌طور نمایان بکار می‌برند.',
                'en' => 'A brick is building material used to make walls, pavements and other elements in masonry construction. Traditionally, the term brick referred to a unit composed of clay, but it is now used to denote rectangular units made of clay-bearing soil, sand, and lime, or concrete materials. Bricks can be joined together using mortar, adhesives or by interlocking them.[1][2] Bricks are produced in numerous classes, types, materials, and sizes which vary with region and time period, and are produced in bulk quantities. Two basic categories of bricks are fired and non-fired bricks. ',
                'tr' => 'Tuğla, harç ile biribirine tutturularak duvar inşasında kullanılan, pişmiş veya kurutulmuş kil bazlı topraktan elde edilen yapı malzemesi. Çoğunlukla dikdörtgenler prizması şeklindedir.'
            ]
        ]);
        $this->create($obj[2], [
            'title' => [
                'fa' => 'سیب',
                'en' => 'Apple',
                'tr' => 'Elma'
            ],
            'description' => [
                'fa' => 'درخت سیب (نام علمی: M. pumila) درختی برگریز از خانواده گلسرخیان است که به خاطر میوه شیرین و گوشتی‌اش شناخته شده‌است. در سرتاسر دنیا، این درخت برای میوه‌اش کشت می‌شود و وسیع‌ترین گونهٔ رشد کرده از سرده مالوس است. منشأ این درخت آسیای مرکزی است؛ جایی که امروزه هنوز هم گونهٔ وحشی آن یعنی مالوس سیورسی یافت می‌شود. سیب پس از هزاران سال کشت در آسیا و اروپا، توسط مهاجران اروپایی به آمریکای شمالی برده شد. سیب در برخی فرهنگ‌ها از اهمیت مذهبی و اساطیری بالایی برخوردار است، از جمله فرهنگ اهالی اسکاندیناوی، یونان و مسیحیان اروپایی قدیم. سیب همچنین یکی از سین‌های اصلی هفت‌سین است. ',
                'en' => 'An apple is a sweet, edible fruit produced by an apple tree (Malus domestica). Apple trees are cultivated worldwide and are the most widely grown species in the genus Malus. The tree originated in Central Asia, where its wild ancestor, Malus sieversii, is still found today. Apples have been grown for thousands of years in Asia and Europe and were brought to North America by European colonists. Apples have religious and mythological significance in many cultures, including Norse, Greek and European Christian traditions. ',
                'tr' => 'Eski Türkçede "alma" diye bilinen adının, meyvenin rengi olan "al" (kırmızı)\'dan geldiği bilinmektedir. Elmanın ilk olarak Kuzey Anadolu\'da, Güney Kafkaslar,[1] Rusya\'nın güneybatısında kalan bölgeler ve Orta Asya (Kazakistan\'ın doğusu) dolaylarında ortaya çıktığı sanılmaktadır. Tür, bütün dünyaya Orta Asya\'dan yayılmıştır. Besin değeri çok yüksek olan bir meyvesi vardır. Tarih boyunca kültür çalışmalarıyla 1000 farklı elma çeşidi üretildiği tahmin edilmektedir. '
            ]
        ]);
        $this->create($obj[3], [
            'title' => [
                'fa' => 'پرتقال',
                'en' => 'Orange',
                'tr' => 'Portakal'
            ],
            'description' => [
                'fa' => 'پرتقال درخت کوچکی است با برگ‌های سبز و گل‌های سفید، پوست میوهٔ آن نارنجی رنگ، کمی ناصاف و میوه آن بسته به انواع مختلف شیرین و ترش، زرد رنگ یا قرمز، و سرشار از ویتامین ث است. پرتقال یکی از قدیمی‌ترین میوه‌هایی است که بشر از آن استفاده می‌کرده‌است و در حدود ۵۰۰ سال قبل از میلاد مسیح کنفوسیوس از آن نام برده‌است. ',
                'en' => 'The orange is the fruit of the citrus species Citrus × sinensis in the family Rutaceae, native to China.[1] It is also called sweet orange, to distinguish it from the related Citrus × aurantium, referred to as bitter orange. The sweet orange reproduces asexually (apomixis through nucellar embryony); varieties of sweet orange arise through mutations.',
                'tr' => 'İpek yolunun Anadolu\'dan geçtiği dönemlerde narenciye Hindistan civarından gelen ticari bir üründü. Ümit Burnu\'nun keşfedilmesiyle ticaret yolları değişmiş, Asya kıtasının Avrupalı devletler tarafından sömürgeleştirilmesiyle portakal üretiminin tamamı Portekiz civarına yayılmıştır. Türk topraklarına ilk kez Portekiz\'den geldiği için Portekiz meyvesi anlamında Portakal (Portugal) meyvesi denmiş, zaman içinde de sadeleşerek portakala dönüşmüştür. Portakal\'ın Pomelo ile Mandalina\'nın doğal melezi olduğu sanılmaktadır. '
            ]
        ]);
        $this->create($obj[4], [
            'title' => [
                'fa' => 'پفک',
                'en' => 'Snack',
                'tr' => 'Pofak'
            ],
            'description' => [
                'fa' => 'پُفک نام یک نوع اسنک است که از ذرت حرارت‌داده‌شده تهیه می‌شود.[۱] این نشان تجاری متعلق به گروه صنعتی مینو در ایران است.[۲] شهرت این محصول به گونه ای است که این نام تجاری، در گفتار روزمره مردم به اسم عام برای انواع اسنک ذرت/پنیر تبدیل شده است و مردم گاهی محصولات اسنک دیگر شرکتها را هم با نام پفک می شناسند.',
                'en' => 'The orange is the fruit of the citrus species Citrus × sinensis in the family Rutaceae, native to China.[1] It is also called sweet orange, to distinguish it from the related Citrus × aurantium, referred to as bitter orange. The sweet orange reproduces asexually (apomixis through nucellar embryony); varieties of sweet orange arise through mutations.',
                'tr' => 'İpek yolunun Anadolu\'dan geçtiği dönemlerde narenciye Hindistan civarından gelen ticari bir üründü. Ümit Burnu\'nun keşfedilmesiyle ticaret yolları değişmiş, Asya kıtasının Avrupalı devletler tarafından sömürgeleştirilmesiyle portakal üretiminin tamamı Portekiz civarına yayılmıştır. Türk topraklarına ilk kez Portekiz\'den geldiği için Portekiz meyvesi anlamında Portakal (Portugal) meyvesi denmiş, zaman içinde de sadeleşerek portakala dönüşmüştür. Portakal\'ın Pomelo ile Mandalina\'nın doğal melezi olduğu sanılmaktadır. '
            ]
        ]);
        $this->create($obj[5], [
            'title' => [
                'fa' => 'چیپس',
                'en' => 'Chips',
                'tr' => 'cips'
            ],
            'description' => [
                'fa' => 'چیپس سیب‌زمینی یا چیپس نوعی اسنک است که از برش سیب زمینی به ورقه‌های نازک و سرخ کردن آنها در روغن تهیه می‌شود. بیشتر نمک بعنوان افزودنی برای مزه دار کردن چیپس به کار می‌رود، اما از ادویه‌های دیگری مانند فلفل نیز برای مزه دار کردن آن استفاده می‌شود. ',
                'en' => 'The orange is the fruit of the citrus species Citrus × sinensis in the family Rutaceae, native to China.[1] It is also called sweet orange, to distinguish it from the related Citrus × aurantium, referred to as bitter orange. The sweet orange reproduces asexually (apomixis through nucellar embryony); varieties of sweet orange arise through mutations.',
                'tr' => 'İpek yolunun Anadolu\'dan geçtiği dönemlerde narenciye Hindistan civarından gelen ticari bir üründü. Ümit Burnu\'nun keşfedilmesiyle ticaret yolları değişmiş, Asya kıtasının Avrupalı devletler tarafından sömürgeleştirilmesiyle portakal üretiminin tamamı Portekiz civarına yayılmıştır. Türk topraklarına ilk kez Portekiz\'den geldiği için Portekiz meyvesi anlamında Portakal (Portugal) meyvesi denmiş, zaman içinde de sadeleşerek portakala dönüşmüştür. Portakal\'ın Pomelo ile Mandalina\'nın doğal melezi olduğu sanılmaktadır. '
            ]
        ]);
        $this->create($obj[6], [
            'title' => [
                'fa' => 'چای شهرزاد مدل Earl Gray بسته 500 گرمی',
                'en' => 'Earl Gray Shahrzad Tea 500 g',
                'tr' => 'Earl Grey Shahrzad Çay 500 g'
            ],
            'description' => [
                'fa' => 'چای، گیاهی بسیار قدیمی است که ابتدا در کشور چین مشاهده شد و پس از پی بردن به خواص درمانی آن، بسیار محبوب شد و کشورهای اروپایی نیز خواهان این گیاه شفابخش شدند. چای گیاه مناطق آسیای شرقی است که به‌تدریج به دلیل خواص فراوان در مناطق مختلف جهان کشت شد. این گیاه مفید سرشار از آنتی‌اکسیدان است که می‌تواند از بروز سرطان جلوگیری کند؛ همچنین به‌عنوان منبعی از کافئین، شناخته می‌شود و درد عضلات را پس از ورزش کردن کاهش می‌دهد. برگ خشک‌شده چای، به‌طورمعمول مورداستفاده قرار می‌گیرد اما دم کردن گیاه تازه آن می‌تواند بسیار مفید و لذت‌بخش‌تر باشد. مصرف چای پس از طی کردن یک روز طولانی می‌تواند انرژی شما را بازیابی کند و به‌قول معروف، خستگی شما را بیرون کند. چای سیاه در ایران بسیار پرطرفدار است ، اما به دلیل خواص فراوان چای سبز، این چای نیز توانسته محبوب شود. چای ارل گری شهرزاد یک چای خوش‌بو است که 500 گرم وزن دارد و در کنار توت خشک در یک روز بارانی، می‌توانید از آن لذت ببرید.',
            ]
        ]);

        # Media
        $obj[1]->addMedia(base_path('resources/dummy/img/brick.jpg'))
            ->preservingOriginal()
            ->toMediaCollection('image');

        $obj[2]->addMedia(base_path('resources/dummy/img/apple.jpg'))
            ->preservingOriginal()
            ->toMediaCollection('image');

        $obj[3]->addMedia(base_path('resources/dummy/img/orange.jpg'))
            ->preservingOriginal()
            ->toMediaCollection('image');
        $obj[4]->addMedia(base_path('resources/dummy/img/snack.jpg'))
            ->preservingOriginal()
            ->toMediaCollection('image');
        $obj[5]->addMedia(base_path('resources/dummy/img/chips.jpg'))
            ->preservingOriginal()
            ->toMediaCollection('image');
        $obj[6]->addMedia(base_path('resources/dummy/img/chay1.jpg'))
            ->preservingOriginal()
            ->toMediaCollection('image');
        $obj[6]->addMedia(base_path('resources/dummy/img/chay2.jpg'))
            ->preservingOriginal()
            ->toMediaCollection('image');
    }
}
