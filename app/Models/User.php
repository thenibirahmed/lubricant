<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'fathers_name',
        'cell_no',
        'nid',
        'role_id',
        'division',
        'district',
        'subdistrict',
        'trade_lisence',
        'shop_image',
        'shop_name',
        'is_active',
        'dob',
        'se',
        'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role() {
        return $this->belongsTo( 'App\Models\Role' );
    }

    public function dp() {
        return $this->belongsTo( 'App\Models\Media' );
    }

    public function lisence() {
        return $this->belongsTo( 'App\Models\Media', 'trade_lisence' );
    }

    public function shop_img() {
        return $this->belongsTo( 'App\Models\Media', 'shop_image' );
    }

    const divisions = [
        'Chattagram' => 'Chattagram',
        'Rajshahi'   => 'Rajshahi',
        'Khulna'     => 'Khulna',
        'Barisal'    => 'Barisal',
        'Sylhet'     => 'Sylhet',
        'Dhaka'      => 'Dhaka',
        'Rangpur'    => 'Rangpur',
        'Mymensingh' => 'Mymensingh',
    ];

    const districts = array(
        'Comilla'         => 'Comilla',
        'Feni'            => 'Feni',
        'Brahmanbaria'    => 'Brahmanbaria',
        'Rangamati'       => 'Rangamati',
        'Noakhali'        => 'Noakhali',
        'Chandpur'        => 'Chandpur',
        'Lakshmipur'      => 'Lakshmipur',
        'Chattogram'      => 'Chattogram',
        'Coxsbazar'       => 'Coxsbazar',
        'Khagrachhari'    => 'Khagrachhari',
        'Bandarban'       => 'Bandarban',
        'Sirajganj'       => 'Sirajganj',
        'Pabna'           => 'Pabna',
        'Bogura'          => 'Bogura',
        'Rajshahi'        => 'Rajshahi',
        'Natore'          => 'Natore',
        'Joypurhat'       => 'Joypurhat',
        'Chapainawabganj' => 'Chapainawabganj',
        'Naogaon'         => 'Naogaon',
        'Jashore'         => 'Jashore',
        'Satkhira'        => 'Satkhira',
        'Meherpur'        => 'Meherpur',
        'Narail'          => 'Narail',
        'Chuadanga'       => 'Chuadanga',
        'Kushtia'         => 'Kushtia',
        'Magura'          => 'Magura',
        'Khulna'          => 'Khulna',
        'Bagerhat'        => 'Bagerhat',
        'Jhenaidah'       => 'Jhenaidah',
        'Jhalakathi'      => 'Jhalakathi',
        'Patuakhali'      => 'Patuakhali',
        'Pirojpur'        => 'Pirojpur',
        'Barisal'         => 'Barisal',
        'Bhola'           => 'Bhola',
        'Barguna'         => 'Barguna',
        'Sylhet'          => 'Sylhet',
        'Moulvibazar'     => 'Moulvibazar',
        'Habiganj'        => 'Habiganj',
        'Sunamganj'       => 'Sunamganj',
        'Narsingdi'       => 'Narsingdi',
        'Gazipur'         => 'Gazipur',
        'Shariatpur'      => 'Shariatpur',
        'Narayanganj'     => 'Narayanganj',
        'Tangail'         => 'Tangail',
        'Kishoreganj'     => 'Kishoreganj',
        'Manikganj'       => 'Manikganj',
        'Dhaka'           => 'Dhaka',
        'Munshiganj'      => 'Munshiganj',
        'Rajbari'         => 'Rajbari',
        'Madaripur'       => 'Madaripur',
        'Gopalganj'       => 'Gopalganj',
        'Faridpur'        => 'Faridpur',
        'Panchagarh'      => 'Panchagarh',
        'Dinajpur'        => 'Dinajpur',
        'Lalmonirhat'     => 'Lalmonirhat',
        'Nilphamari'      => 'Nilphamari',
        'Gaibandha'       => 'Gaibandha',
        'Thakurgaon'      => 'Thakurgaon',
        'Rangpur'         => 'Rangpur',
        'Kurigram'        => 'Kurigram',
        'Sherpur'         => 'Sherpur',
        'Mymensingh'      => 'Mymensingh',
        'Jamalpur'        => 'Jamalpur',
        'Netrokona'       => 'Netrokona',
    );

    const upazilas = array(
        'Debidwar'              => 'Debidwar',
        'Barura'                => 'Barura',
        'Brahmanpara'           => 'Brahmanpara',
        'Chandina'              => 'Chandina',
        'Chauddagram'           => 'Chauddagram',
        'Daudkandi'             => 'Daudkandi',
        'Homna'                 => 'Homna',
        'Laksam'                => 'Laksam',
        'Muradnagar'            => 'Muradnagar',
        'Nangalkot'             => 'Nangalkot',
        'Comilla Sadar'         => 'Comilla Sadar',
        'Meghna'                => 'Meghna',
        'Monohargonj'           => 'Monohargonj',
        'Sadarsouth'            => 'Sadarsouth',
        'Titas'                 => 'Titas',
        'Burichang'             => 'Burichang',
        'Lalmai'                => 'Lalmai',
        'Chhagalnaiya'          => 'Chhagalnaiya',
        'Feni Sadar'            => 'Feni Sadar',
        'Sonagazi'              => 'Sonagazi',
        'Fulgazi'               => 'Fulgazi',
        'Parshuram'             => 'Parshuram',
        'Daganbhuiyan'          => 'Daganbhuiyan',
        'Brahmanbaria Sadar'    => 'Brahmanbaria Sadar',
        'Kasba'                 => 'Kasba',
        'Nasirnagar'            => 'Nasirnagar',
        'Sarail'                => 'Sarail',
        'Ashuganj'              => 'Ashuganj',
        'Akhaura'               => 'Akhaura',
        'Nabinagar'             => 'Nabinagar',
        'Bancharampur'          => 'Bancharampur',
        'Bijoynagar'            => 'Bijoynagar',
        'Rangamati Sadar'       => 'Rangamati Sadar',
        'Kaptai'                => 'Kaptai',
        'Kawkhali'              => 'Kawkhali',
        'Baghaichari'           => 'Baghaichari',
        'Barkal'                => 'Barkal',
        'Langadu'               => 'Langadu',
        'Rajasthali'            => 'Rajasthali',
        'Belaichari'            => 'Belaichari',
        'Juraichari'            => 'Juraichari',
        'Naniarchar'            => 'Naniarchar',
        'Noakhali Sadar'        => 'Noakhali Sadar',
        'Companiganj'           => 'Companiganj',
        'Begumganj'             => 'Begumganj',
        'Hatia'                 => 'Hatia',
        'Subarnachar'           => 'Subarnachar',
        'Kabirhat'              => 'Kabirhat',
        'Senbug'                => 'Senbug',
        'Chatkhil'              => 'Chatkhil',
        'Sonaimori'             => 'Sonaimori',
        'Haimchar'              => 'Haimchar',
        'Kachua'                => 'Kachua',
        'Shahrasti'             => 'Shahrasti',
        'Chandpur Sadar'        => 'Chandpur Sadar',
        'Matlab South'          => 'Matlab South',
        'Hajiganj'              => 'Hajiganj',
        'Matlab North'          => 'Matlab North',
        'Faridgonj'             => 'Faridgonj',
        'Lakshmipur Sadar'      => 'Lakshmipur Sadar',
        'Kamalnagar'            => 'Kamalnagar',
        'Raipur'                => 'Raipur',
        'Ramgati'               => 'Ramgati',
        'Ramganj'               => 'Ramganj',
        'Rangunia'              => 'Rangunia',
        'Sitakunda'             => 'Sitakunda',
        'Mirsharai'             => 'Mirsharai',
        'Patiya'                => 'Patiya',
        'Sandwip'               => 'Sandwip',
        'Banshkhali'            => 'Banshkhali',
        'Boalkhali'             => 'Boalkhali',
        'Anwara'                => 'Anwara',
        'Chandanaish'           => 'Chandanaish',
        'Satkania'              => 'Satkania',
        'Lohagara'              => 'Lohagara',
        'Hathazari'             => 'Hathazari',
        'Fatikchhari'           => 'Fatikchhari',
        'Raozan'                => 'Raozan',
        'Karnafuli'             => 'Karnafuli',
        'Coxsbazar Sadar'       => 'Coxsbazar Sadar',
        'Chakaria'              => 'Chakaria',
        'Kutubdia'              => 'Kutubdia',
        'Ukhiya'                => 'Ukhiya',
        'Moheshkhali'           => 'Moheshkhali',
        'Pekua'                 => 'Pekua',
        'Ramu'                  => 'Ramu',
        'Teknaf'                => 'Teknaf',
        'Khagrachhari Sadar'    => 'Khagrachhari Sadar',
        'Dighinala'             => 'Dighinala',
        'Panchari'              => 'Panchari',
        'Laxmichhari'           => 'Laxmichhari',
        'Mohalchari'            => 'Mohalchari',
        'Manikchari'            => 'Manikchari',
        'Ramgarh'               => 'Ramgarh',
        'Matiranga'             => 'Matiranga',
        'Guimara'               => 'Guimara',
        'Bandarban Sadar'       => 'Bandarban Sadar',
        'Alikadam'              => 'Alikadam',
        'Naikhongchhari'        => 'Naikhongchhari',
        'Rowangchhari'          => 'Rowangchhari',
        'Lama'                  => 'Lama',
        'Ruma'                  => 'Ruma',
        'Thanchi'               => 'Thanchi',
        'Belkuchi'              => 'Belkuchi',
        'Chauhali'              => 'Chauhali',
        'Kamarkhand'            => 'Kamarkhand',
        'Kazipur'               => 'Kazipur',
        'Raigonj'               => 'Raigonj',
        'Shahjadpur'            => 'Shahjadpur',
        'Sirajganj Sadar'       => 'Sirajganj Sadar',
        'Tarash'                => 'Tarash',
        'Ullapara'              => 'Ullapara',
        'Sujanagar'             => 'Sujanagar',
        'Ishurdi'               => 'Ishurdi',
        'Bhangura'              => 'Bhangura',
        'Pabna Sadar'           => 'Pabna Sadar',
        'Bera'                  => 'Bera',
        'Atghoria'              => 'Atghoria',
        'Chatmohar'             => 'Chatmohar',
        'Santhia'               => 'Santhia',
        'Faridpur'              => 'Faridpur',
        'Kahaloo'               => 'Kahaloo',
        'Bogra Sadar'           => 'Bogra Sadar',
        'Shariakandi'           => 'Shariakandi',
        'Shajahanpur'           => 'Shajahanpur',
        'Dupchanchia'           => 'Dupchanchia',
        'Adamdighi'             => 'Adamdighi',
        'Nondigram'             => 'Nondigram',
        'Sonatala'              => 'Sonatala',
        'Dhunot'                => 'Dhunot',
        'Gabtali'               => 'Gabtali',
        'Sherpur'               => 'Sherpur',
        'Shibganj'              => 'Shibganj',
        'Paba'                  => 'Paba',
        'Durgapur'              => 'Durgapur',
        'Mohonpur'              => 'Mohonpur',
        'Charghat'              => 'Charghat',
        'Puthia'                => 'Puthia',
        'Bagha'                 => 'Bagha',
        'Godagari'              => 'Godagari',
        'Tanore'                => 'Tanore',
        'Bagmara'               => 'Bagmara',
        'Natore Sadar'          => 'Natore Sadar',
        'Singra'                => 'Singra',
        'Baraigram'             => 'Baraigram',
        'Bagatipara'            => 'Bagatipara',
        'Lalpur'                => 'Lalpur',
        'Gurudaspur'            => 'Gurudaspur',
        'Naldanga'              => 'Naldanga',
        'Akkelpur'              => 'Akkelpur',
        'Kalai'                 => 'Kalai',
        'Khetlal'               => 'Khetlal',
        'Panchbibi'             => 'Panchbibi',
        'Joypurhat Sadar'       => 'Joypurhat Sadar',
        'Chapainawabganj Sadar' => 'Chapainawabganj Sadar',
        'Gomostapur'            => 'Gomostapur',
        'Nachol'                => 'Nachol',
        'Bholahat'              => 'Bholahat',
        'Mohadevpur'            => 'Mohadevpur',
        'Badalgachi'            => 'Badalgachi',
        'Patnitala'             => 'Patnitala',
        'Dhamoirhat'            => 'Dhamoirhat',
        'Niamatpur'             => 'Niamatpur',
        'Manda'                 => 'Manda',
        'Atrai'                 => 'Atrai',
        'Raninagar'             => 'Raninagar',
        'Naogaon Sadar'         => 'Naogaon Sadar',
        'Porsha'                => 'Porsha',
        'Sapahar'               => 'Sapahar',
        'Manirampur'            => 'Manirampur',
        'Abhaynagar'            => 'Abhaynagar',
        'Bagherpara'            => 'Bagherpara',
        'Chougachha'            => 'Chougachha',
        'Jhikargacha'           => 'Jhikargacha',
        'Keshabpur'             => 'Keshabpur',
        'Jessore Sadar'         => 'Jessore Sadar',
        'Sharsha'               => 'Sharsha',
        'Assasuni'              => 'Assasuni',
        'Debhata'               => 'Debhata',
        'Kalaroa'               => 'Kalaroa',
        'Satkhira Sadar'        => 'Satkhira Sadar',
        'Shyamnagar'            => 'Shyamnagar',
        'Tala'                  => 'Tala',
        'Kaliganj'              => 'Kaliganj',
        'Mujibnagar'            => 'Mujibnagar',
        'Meherpur Sadar'        => 'Meherpur Sadar',
        'Gangni'                => 'Gangni',
        'Narail Sadar'          => 'Narail Sadar',
        'Kalia'                 => 'Kalia',
        'Chuadanga Sadar'       => 'Chuadanga Sadar',
        'Alamdanga'             => 'Alamdanga',
        'Damurhuda'             => 'Damurhuda',
        'Jibannagar'            => 'Jibannagar',
        'Kushtia Sadar'         => 'Kushtia Sadar',
        'Kumarkhali'            => 'Kumarkhali',
        'Khoksa'                => 'Khoksa',
        'Mirpur'                => 'Mirpur',
        'Daulatpur'             => 'Daulatpur',
        'Bheramara'             => 'Bheramara',
        'Shalikha'              => 'Shalikha',
        'Sreepur'               => 'Sreepur',
        'Magura Sadar'          => 'Magura Sadar',
        'Mohammadpur'           => 'Mohammadpur',
        'Paikgasa'              => 'Paikgasa',
        'Fultola'               => 'Fultola',
        'Digholia'              => 'Digholia',
        'Rupsha'                => 'Rupsha',
        'Terokhada'             => 'Terokhada',
        'Dumuria'               => 'Dumuria',
        'Botiaghata'            => 'Botiaghata',
        'Dakop'                 => 'Dakop',
        'Koyra'                 => 'Koyra',
        'Fakirhat'              => 'Fakirhat',
        'Bagerhat Sadar'        => 'Bagerhat Sadar',
        'Mollahat'              => 'Mollahat',
        'Sarankhola'            => 'Sarankhola',
        'Rampal'                => 'Rampal',
        'Morrelganj'            => 'Morrelganj',
        'Mongla'                => 'Mongla',
        'Chitalmari'            => 'Chitalmari',
        'Jhenaidah Sadar'       => 'Jhenaidah Sadar',
        'Shailkupa'             => 'Shailkupa',
        'Harinakundu'           => 'Harinakundu',
        'Kotchandpur'           => 'Kotchandpur',
        'Moheshpur'             => 'Moheshpur',
        'Jhalakathi Sadar'      => 'Jhalakathi Sadar',
        'Kathalia'              => 'Kathalia',
        'Nalchity'              => 'Nalchity',
        'Rajapur'               => 'Rajapur',
        'Bauphal'               => 'Bauphal',
        'Patuakhali Sadar'      => 'Patuakhali Sadar',
        'Dumki'                 => 'Dumki',
        'Dashmina'              => 'Dashmina',
        'Kalapara'              => 'Kalapara',
        'Mirzaganj'             => 'Mirzaganj',
        'Galachipa'             => 'Galachipa',
        'Rangabali'             => 'Rangabali',
        'Pirojpur Sadar'        => 'Pirojpur Sadar',
        'Nazirpur'              => 'Nazirpur',
        'Zianagar'              => 'Zianagar',
        'Bhandaria'             => 'Bhandaria',
        'Mathbaria'             => 'Mathbaria',
        'Nesarabad'             => 'Nesarabad',
        'Barisal Sadar'         => 'Barisal Sadar',
        'Bakerganj'             => 'Bakerganj',
        'Babuganj'              => 'Babuganj',
        'Wazirpur'              => 'Wazirpur',
        'Banaripara'            => 'Banaripara',
        'Gournadi'              => 'Gournadi',
        'Agailjhara'            => 'Agailjhara',
        'Mehendiganj'           => 'Mehendiganj',
        'Muladi'                => 'Muladi',
        'Hizla'                 => 'Hizla',
        'Bhola Sadar'           => 'Bhola Sadar',
        'Borhan Sddin'          => 'Borhan Sddin',
        'Charfesson'            => 'Charfesson',
        'Doulatkhan'            => 'Doulatkhan',
        'Monpura'               => 'Monpura',
        'Tazumuddin'            => 'Tazumuddin',
        'Lalmohan'              => 'Lalmohan',
        'Amtali'                => 'Amtali',
        'Barguna Sadar'         => 'Barguna Sadar',
        'Betagi'                => 'Betagi',
        'Bamna'                 => 'Bamna',
        'Pathorghata'           => 'Pathorghata',
        'Taltali'               => 'Taltali',
        'Balaganj'              => 'Balaganj',
        'Beanibazar'            => 'Beanibazar',
        'Bishwanath'            => 'Bishwanath',
        'Fenchuganj'            => 'Fenchuganj',
        'Golapganj'             => 'Golapganj',
        'Gowainghat'            => 'Gowainghat',
        'Jaintiapur'            => 'Jaintiapur',
        'Kanaighat'             => 'Kanaighat',
        'Sylhet Sadar'          => 'Sylhet Sadar',
        'Zakiganj'              => 'Zakiganj',
        'Dakshinsurma'          => 'Dakshinsurma',
        'Osmaninagar'           => 'Osmaninagar',
        'Barlekha'              => 'Barlekha',
        'Kamolganj'             => 'Kamolganj',
        'Kulaura'               => 'Kulaura',
        'Moulvibazar Sadar'     => 'Moulvibazar Sadar',
        'Rajnagar'              => 'Rajnagar',
        'Sreemangal'            => 'Sreemangal',
        'Juri'                  => 'Juri',
        'Nabiganj'              => 'Nabiganj',
        'Bahubal'               => 'Bahubal',
        'Ajmiriganj'            => 'Ajmiriganj',
        'Baniachong'            => 'Baniachong',
        'Lakhai'                => 'Lakhai',
        'Chunarughat'           => 'Chunarughat',
        'Habiganj Sadar'        => 'Habiganj Sadar',
        'Madhabpur'             => 'Madhabpur',
        'Sunamganj Sadar'       => 'Sunamganj Sadar',
        'South Sunamganj'       => 'South Sunamganj',
        'Bishwambarpur'         => 'Bishwambarpur',
        'Chhatak'               => 'Chhatak',
        'Jagannathpur'          => 'Jagannathpur',
        'Dowarabazar'           => 'Dowarabazar',
        'Tahirpur'              => 'Tahirpur',
        'Dharmapasha'           => 'Dharmapasha',
        'Jamalganj'             => 'Jamalganj',
        'Shalla'                => 'Shalla',
        'Derai'                 => 'Derai',
        'Belabo'                => 'Belabo',
        'Monohardi'             => 'Monohardi',
        'Narsingdi Sadar'       => 'Narsingdi Sadar',
        'Palash'                => 'Palash',
        'Raipura'               => 'Raipura',
        'Shibpur'               => 'Shibpur',
        'Kaliakair'             => 'Kaliakair',
        'Kapasia'               => 'Kapasia',
        'Gazipur Sadar'         => 'Gazipur Sadar',
        'Shariatpur Sadar'      => 'Shariatpur Sadar',
        'Naria'                 => 'Naria',
        'Zajira'                => 'Zajira',
        'Gosairhat'             => 'Gosairhat',
        'Bhedarganj'            => 'Bhedarganj',
        'Damudya'               => 'Damudya',
        'Araihazar'             => 'Araihazar',
        'Bandar'                => 'Bandar',
        'Narayanganj Sadar'     => 'Narayanganj Sadar',
        'Rupganj'               => 'Rupganj',
        'Sonargaon'             => 'Sonargaon',
        'Basail'                => 'Basail',
        'Bhuapur'               => 'Bhuapur',
        'Delduar'               => 'Delduar',
        'Ghatail'               => 'Ghatail',
        'Gopalpur'              => 'Gopalpur',
        'Madhupur'              => 'Madhupur',
        'Mirzapur'              => 'Mirzapur',
        'Nagarpur'              => 'Nagarpur',
        'Sakhipur'              => 'Sakhipur',
        'Tangail Sadar'         => 'Tangail Sadar',
        'Kalihati'              => 'Kalihati',
        'Dhanbari'              => 'Dhanbari',
        'Itna'                  => 'Itna',
        'Katiadi'               => 'Katiadi',
        'Bhairab'               => 'Bhairab',
        'Tarail'                => 'Tarail',
        'Hossainpur'            => 'Hossainpur',
        'Pakundia'              => 'Pakundia',
        'Kuliarchar'            => 'Kuliarchar',
        'Kishoreganj Sadar'     => 'Kishoreganj Sadar',
        'Karimgonj'             => 'Karimgonj',
        'Bajitpur'              => 'Bajitpur',
        'Austagram'             => 'Austagram',
        'Mithamoin'             => 'Mithamoin',
        'Nikli'                 => 'Nikli',
        'Harirampur'            => 'Harirampur',
        'Saturia'               => 'Saturia',
        'Manikganj Sadar'       => 'Manikganj Sadar',
        'Gior'                  => 'Gior',
        'Shibaloy'              => 'Shibaloy',
        'Doulatpur'             => 'Doulatpur',
        'Singiar'               => 'Singiar',
        'Savar'                 => 'Savar',
        'Dhamrai'               => 'Dhamrai',
        'Keraniganj'            => 'Keraniganj',
        'Nawabganj'             => 'Nawabganj',
        'Dohar'                 => 'Dohar',
        'Munshiganj Sadar'      => 'Munshiganj Sadar',
        'Sreenagar'             => 'Sreenagar',
        'Sirajdikhan'           => 'Sirajdikhan',
        'Louhajanj'             => 'Louhajanj',
        'Gajaria'               => 'Gajaria',
        'Tongibari'             => 'Tongibari',
        'Rajbari Sadar'         => 'Rajbari Sadar',
        'Goalanda'              => 'Goalanda',
        'Pangsa'                => 'Pangsa',
        'Baliakandi'            => 'Baliakandi',
        'Kalukhali'             => 'Kalukhali',
        'Madaripur Sadar'       => 'Madaripur Sadar',
        'Shibchar'              => 'Shibchar',
        'Kalkini'               => 'Kalkini',
        'Rajoir'                => 'Rajoir',
        'Gopalganj Sadar'       => 'Gopalganj Sadar',
        'Kashiani'              => 'Kashiani',
        'Tungipara'             => 'Tungipara',
        'Kotalipara'            => 'Kotalipara',
        'Muksudpur'             => 'Muksudpur',
        'Faridpur Sadar'        => 'Faridpur Sadar',
        'Alfadanga'             => 'Alfadanga',
        'Boalmari'              => 'Boalmari',
        'Sadarpur'              => 'Sadarpur',
        'Nagarkanda'            => 'Nagarkanda',
        'Bhanga'                => 'Bhanga',
        'Charbhadrasan'         => 'Charbhadrasan',
        'Madhukhali'            => 'Madhukhali',
        'Saltha'                => 'Saltha',
        'Panchagarh Sadar'      => 'Panchagarh Sadar',
        'Debiganj'              => 'Debiganj',
        'Boda'                  => 'Boda',
        'Atwari'                => 'Atwari',
        'Tetulia'               => 'Tetulia',
        'Birganj'               => 'Birganj',
        'Ghoraghat'             => 'Ghoraghat',
        'Birampur'              => 'Birampur',
        'Parbatipur'            => 'Parbatipur',
        'Bochaganj'             => 'Bochaganj',
        'Kaharol'               => 'Kaharol',
        'Fulbari'               => 'Fulbari',
        'Dinajpur Sadar'        => 'Dinajpur Sadar',
        'Hakimpur'              => 'Hakimpur',
        'Khansama'              => 'Khansama',
        'Birol'                 => 'Birol',
        'Chirirbandar'          => 'Chirirbandar',
        'Lalmonirhat Sadar'     => 'Lalmonirhat Sadar',
        'Hatibandha'            => 'Hatibandha',
        'Patgram'               => 'Patgram',
        'Aditmari'              => 'Aditmari',
        'Syedpur'               => 'Syedpur',
        'Domar'                 => 'Domar',
        'Dimla'                 => 'Dimla',
        'Jaldhaka'              => 'Jaldhaka',
        'Kishorganj'            => 'Kishorganj',
        'Nilphamari Sadar'      => 'Nilphamari Sadar',
        'Sadullapur'            => 'Sadullapur',
        'Gaibandha Sadar'       => 'Gaibandha Sadar',
        'Palashbari'            => 'Palashbari',
        'Saghata'               => 'Saghata',
        'Gobindaganj'           => 'Gobindaganj',
        'Sundarganj'            => 'Sundarganj',
        'Phulchari'             => 'Phulchari',
        'Thakurgaon Sadar'      => 'Thakurgaon Sadar',
        'Pirganj'               => 'Pirganj',
        'Ranisankail'           => 'Ranisankail',
        'Haripur'               => 'Haripur',
        'Baliadangi'            => 'Baliadangi',
        'Rangpur Sadar'         => 'Rangpur Sadar',
        'Gangachara'            => 'Gangachara',
        'Taragonj'              => 'Taragonj',
        'Badargonj'             => 'Badargonj',
        'Mithapukur'            => 'Mithapukur',
        'Pirgonj'               => 'Pirgonj',
        'Kaunia'                => 'Kaunia',
        'Pirgacha'              => 'Pirgacha',
        'Kurigram Sadar'        => 'Kurigram Sadar',
        'Nageshwari'            => 'Nageshwari',
        'Bhurungamari'          => 'Bhurungamari',
        'Phulbari'              => 'Phulbari',
        'Rajarhat'              => 'Rajarhat',
        'Ulipur'                => 'Ulipur',
        'Chilmari'              => 'Chilmari',
        'Rowmari'               => 'Rowmari',
        'Charrajibpur'          => 'Charrajibpur',
        'Sherpur Sadar'         => 'Sherpur Sadar',
        'Nalitabari'            => 'Nalitabari',
        'Sreebordi'             => 'Sreebordi',
        'Nokla'                 => 'Nokla',
        'Jhenaigati'            => 'Jhenaigati',
        'Fulbaria'              => 'Fulbaria',
        'Trishal'               => 'Trishal',
        'Bhaluka'               => 'Bhaluka',
        'Muktagacha'            => 'Muktagacha',
        'Mymensingh Sadar'      => 'Mymensingh Sadar',
        'Dhobaura'              => 'Dhobaura',
        'Phulpur'               => 'Phulpur',
        'Haluaghat'             => 'Haluaghat',
        'Gouripur'              => 'Gouripur',
        'Gafargaon'             => 'Gafargaon',
        'Iswarganj'             => 'Iswarganj',
        'Nandail'               => 'Nandail',
        'Tarakanda'             => 'Tarakanda',
        'Jamalpur Sadar'        => 'Jamalpur Sadar',
        'Melandah'              => 'Melandah',
        'Islampur'              => 'Islampur',
        'Dewangonj'             => 'Dewangonj',
        'Sarishabari'           => 'Sarishabari',
        'Madarganj'             => 'Madarganj',
        'Bokshiganj'            => 'Bokshiganj',
        'Barhatta'              => 'Barhatta',
        'Kendua'                => 'Kendua',
        'Atpara'                => 'Atpara',
        'Madan'                 => 'Madan',
        'Khaliajuri'            => 'Khaliajuri',
        'Kalmakanda'            => 'Kalmakanda',
        'Mohongonj'             => 'Mohongonj',
        'Purbadhala'            => 'Purbadhala',
        'Netrokona Sadar'       => 'Netrokona Sadar',
    );

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
