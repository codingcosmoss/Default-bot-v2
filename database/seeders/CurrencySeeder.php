<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            ['name' => 'USD', 'sign' => '$', 'title' => 'Dollar'],
            ['name' => 'EUR', 'sign' => '€', 'title' => 'Euro'],
            ['name' => 'GBP', 'sign' => '£', 'title' => 'Pound Sterling'],
            ['name' => 'JPY', 'sign' => '¥', 'title' => 'Japanese Yen'],
            ['name' => 'CHF', 'sign' => 'CHF', 'title' => 'Swiss Franc'],
            ['name' => 'CAD', 'sign' => '$', 'title' => 'Canadian Dollar'],
            ['name' => 'AUD', 'sign' => '$', 'title' => 'Australian Dollar'],
            ['name' => 'NZD', 'sign' => '$', 'title' => 'New Zealand Dollar'],
            ['name' => 'CNY', 'sign' => '¥', 'title' => 'Chinese Yuan'],
            ['name' => 'SEK', 'sign' => 'kr', 'title' => 'Swedish Krona'],
            ['name' => 'NOK', 'sign' => 'kr', 'title' => 'Norwegian Krone'],
            ['name' => 'DKK', 'sign' => 'kr', 'title' => 'Danish Krone'],
            ['name' => 'INR', 'sign' => '₹', 'title' => 'Indian Rupee'],
            ['name' => 'RUB', 'sign' => '₽', 'title' => 'Russian Ruble'],
            ['name' => 'BRL', 'sign' => 'R$', 'title' => 'Brazilian Real'],
            ['name' => 'ZAR', 'sign' => 'R', 'title' => 'South African Rand'],
            ['name' => 'SGD', 'sign' => '$', 'title' => 'Singapore Dollar'],
            ['name' => 'HKD', 'sign' => '$', 'title' => 'Hong Kong Dollar'],
            ['name' => 'MXN', 'sign' => '$', 'title' => 'Mexican Peso'],
            ['name' => 'KRW', 'sign' => '₩', 'title' => 'South Korean Won'],
            ['name' => 'TRY', 'sign' => '₺', 'title' => 'Turkish Lira'],
            ['name' => 'SAR', 'sign' => 'ر.س', 'title' => 'Saudi Riyal'],
            ['name' => 'AED', 'sign' => 'د.إ', 'title' => 'United Arab Emirates Dirham'],
            ['name' => 'MYR', 'sign' => 'RM', 'title' => 'Malaysian Ringgit'],
            ['name' => 'IDR', 'sign' => 'Rp', 'title' => 'Indonesian Rupiah'],
            ['name' => 'PHP', 'sign' => '₱', 'title' => 'Philippine Peso'],
            ['name' => 'THB', 'sign' => '฿', 'title' => 'Thai Baht'],
            ['name' => 'PLN', 'sign' => 'zł', 'title' => 'Polish Zloty'],
            ['name' => 'ARS', 'sign' => '$', 'title' => 'Argentine Peso'],
            ['name' => 'CLP', 'sign' => '$', 'title' => 'Chilean Peso'],
            ['name' => 'COP', 'sign' => '$', 'title' => 'Colombian Peso'],
            ['name' => 'PEN', 'sign' => 'S/', 'title' => 'Peruvian Sol'],
            ['name' => 'VND', 'sign' => '₫', 'title' => 'Vietnamese Dong'],
            ['name' => 'EGP', 'sign' => '£', 'title' => 'Egyptian Pound'],
            ['name' => 'UAH', 'sign' => '₴', 'title' => 'Ukrainian Hryvnia'],
            ['name' => 'KZT', 'sign' => '₸', 'title' => 'Kazakhstani Tenge'],
            ['name' => 'PKR', 'sign' => '₨', 'title' => 'Pakistani Rupee'],
            ['name' => 'BDT', 'sign' => '৳', 'title' => 'Bangladeshi Taka'],
            ['name' => 'NGN', 'sign' => '₦', 'title' => 'Nigerian Naira'],
            ['name' => 'KES', 'sign' => 'KSh', 'title' => 'Kenyan Shilling'],
            ['name' => 'GHS', 'sign' => '₵', 'title' => 'Ghanaian Cedi'],
            ['name' => 'TZS', 'sign' => 'TSh', 'title' => 'Tanzanian Shilling'],
            ['name' => 'UGX', 'sign' => 'USh', 'title' => 'Ugandan Shilling'],
            ['name' => 'ETB', 'sign' => 'Br', 'title' => 'Ethiopian Birr'],
            ['name' => 'ZMW', 'sign' => 'ZK', 'title' => 'Zambian Kwacha'],
            ['name' => 'MAD', 'sign' => 'د.م.', 'title' => 'Moroccan Dirham'],
            ['name' => 'TND', 'sign' => 'د.ت', 'title' => 'Tunisian Dinar'],
            ['name' => 'ILS', 'sign' => '₪', 'title' => 'Israeli Shekel'],
            ['name' => 'QAR', 'sign' => 'ر.ق', 'title' => 'Qatari Riyal'],
            ['name' => 'OMR', 'sign' => 'ر.ع.', 'title' => 'Omani Rial'],
            ['name' => 'KWD', 'sign' => 'د.ك', 'title' => 'Kuwaiti Dinar'],
            ['name' => 'BHD', 'sign' => 'ب.د', 'title' => 'Bahraini Dinar'],
            ['name' => 'JOD', 'sign' => 'د.ا', 'title' => 'Jordanian Dinar'],
            ['name' => 'LBP', 'sign' => 'ل.ل', 'title' => 'Lebanese Pound'],
            ['name' => 'SYP', 'sign' => '£', 'title' => 'Syrian Pound'],
            ['name' => 'IQD', 'sign' => 'ع.د', 'title' => 'Iraqi Dinar'],
            ['name' => 'IRR', 'sign' => '﷼', 'title' => 'Iranian Rial'],
            ['name' => 'AFN', 'sign' => '؋', 'title' => 'Afghan Afghani'],
            ['name' => 'AMD', 'sign' => '֏', 'title' => 'Armenian Dram'],
            ['name' => 'AZN', 'sign' => '₼', 'title' => 'Azerbaijani Manat'],
            ['name' => 'GEL', 'sign' => '₾', 'title' => 'Georgian Lari'],
            ['name' => 'KGS', 'sign' => 'лв', 'title' => 'Kyrgyzstani Som'],
            ['name' => 'MNT', 'sign' => '₮', 'title' => 'Mongolian Tugrik'],
            ['name' => 'LKR', 'sign' => 'Rs', 'title' => 'Sri Lankan Rupee'],
            ['name' => 'NPR', 'sign' => '₨', 'title' => 'Nepalese Rupee'],
            ['name' => 'UZS', 'sign' => 'сўм', 'title' => 'Uzbekistani Som'],
            ['name' => 'TMT', 'sign' => 'm', 'title' => 'Turkmenistan Manat'],
            ['name' => 'TJS', 'sign' => 'SM', 'title' => 'Tajikistani Somoni'],
            ['name' => 'MGA', 'sign' => 'Ar', 'title' => 'Malagasy Ariary'],
            ['name' => 'MUR', 'sign' => '₨', 'title' => 'Mauritian Rupee'],
            ['name' => 'SCR', 'sign' => '₨', 'title' => 'Seychellois Rupee'],
            ['name' => 'CVE', 'sign' => '$', 'title' => 'Cape Verdean Escudo'],
            ['name' => 'XAF', 'sign' => 'FCFA', 'title' => 'Central African CFA Franc'],
            ['name' => 'XOF', 'sign' => 'CFA', 'title' => 'West African CFA Franc'],
            ['name' => 'BWP', 'sign' => 'P', 'title' => 'Botswana Pula'],
            ['name' => 'NAD', 'sign' => '$', 'title' => 'Namibian Dollar'],
            ['name' => 'ZWL', 'sign' => '$', 'title' => 'Zimbabwean Dollar'],
            ['name' => 'SOS', 'sign' => 'Sh', 'title' => 'Somali Shilling'],
            ['name' => 'CDF', 'sign' => 'FC', 'title' => 'Congolese Franc'],
            ['name' => 'BIF', 'sign' => 'FBu', 'title' => 'Burundian Franc'],
            ['name' => 'RWF', 'sign' => 'FRw', 'title' => 'Rwandan Franc'],
            ['name' => 'SLL', 'sign' => 'Le', 'title' => 'Sierra Leonean Leone'],
            ['name' => 'GNF', 'sign' => 'FG', 'title' => 'Guinean Franc'],
            ['name' => 'GMD', 'sign' => 'D', 'title' => 'Gambian Dalasi'],
            ['name' => 'MWK', 'sign' => 'MK', 'title' => 'Malawian Kwacha'],
            ['name' => 'MZN', 'sign' => 'MT', 'title' => 'Mozambican Metical'],
            ['name' => 'AOA', 'sign' => 'Kz', 'title' => 'Angolan Kwanza'],
            ['name' => 'LSL', 'sign' => 'L', 'title' => 'Lesotho Loti'],
            ['name' => 'SZL', 'sign' => 'E', 'title' => 'Swazi Lilangeni'],
        ];
        foreach( $currencies as $currency ){
            Currency::create([
                'title' => $currency['title'],
                'name' => $currency['name'],
                'sign' => $currency['sign'],
            ]);
        }

    }
}
