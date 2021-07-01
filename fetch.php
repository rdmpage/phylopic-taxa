<?php

// Get image from phylopic

//--------------------------------------------------------------------------
/**
 * @brief Test whether HTTP code is valid
 *
 * HTTP codes 200 and 302 are OK.
 *
 * For JSTOR we also accept 403
 *
 * @param HTTP code
 *
 * @result True if HTTP code is valid
 */
function HttpCodeValid($http_code)
{
	if ( ($http_code == '200') || ($http_code == '302') || ($http_code == '403'))
	{
		return true;
	}
	else{
		return false;
	}
}


//--------------------------------------------------------------------------
/**
 * @brief GET a resource
 *
 * Make the HTTP GET call to retrieve the record pointed to by the URL. 
 *
 * @param url URL of resource
 *
 * @result Contents of resource
 */
function get($url, $userAgent = '', $content_type = '')
{
	global $config;
	
	$data = '';
	
	$ch = curl_init(); 
	curl_setopt ($ch, CURLOPT_URL, $url); 
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt ($ch, CURLOPT_FOLLOWLOCATION,	1); 
	curl_setopt ($ch, CURLOPT_HEADER,		  1);  
	
	// timeout (seconds)
	curl_setopt ($ch, CURLOPT_TIMEOUT, 120);

	curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
	
	if ($userAgent != '')
	{
		curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
	}	
	
	
	if ($content_type != '')
	{
		curl_setopt ($ch, CURLOPT_HTTPHEADER, array ("Accept: " . $content_type));
    }
	
			
	$curl_result = curl_exec ($ch); 
	
	//echo $curl_result;
	//exit();
	
	if (curl_errno ($ch) != 0 )
	{
		echo "CURL error: ", curl_errno ($ch), " ", curl_error($ch);
	}
	else
	{
		$info = curl_getinfo($ch);
		
		//print_r($info);
		
		 
		$header = substr($curl_result, 0, $info['header_size']);
		
		//echo $header;
		
		
		$http_code = $info['http_code'];
		
		//echo "HTTP code=$http_code\n";
		
		if (HttpCodeValid ($http_code))
		{
			$data = substr($curl_result, $info['header_size']);
			//$data = $curl_result;
		}
	}
	return $data;
}


$names = array(
"Acari",
"Amblypygi",
"Anthracomartida",
"Araneae",
"Architarbida",
"Haptopodida",
"Kustarachnida",
"Opiliones",
"Palpigradi",
"Pseudoscorpionida",
"Ricinulei",
"Schizomida",
"Scorpiones",
"Solpugida",
"Trigonotarbida",
"Uropygi",
"Anostraca",
"Cladocera",
"Conchostraca",
"Cryptopoda",
"Kazacharthra",
"Lipostraca",
"Notostraca",
"Pectocaridida",
"Acrothoracica",
"Ascothoracica",
"Rhizocephala",
"Thoracica",
"Calanoida",
"Cyclopoida",
"Gelyelloida",
"Harpacticoida",
"Misophrioida",
"Monstrilloida",
"Mormonilloida",
"Platycopioida",
"Siphonostomatoida",
"Eocaridacea",
"Pygocephalomorpha",
"Amphionidacea",
"Decapoda",
"Euphausiacea",
"Palaeostomatopoda",
"Stomatopoda",
"Amphipoda",
"Anthracocaridacea",
"Cumacea",
"Isopoda",
"Mictacea",
"Mysidacea",
"Spelaeogriphacea",
"Tanaidacea",
"Thermosbaenacea",
"Anaspidacea",
"Bathynellacea",
"Palaeocaridacea",
"Anoplura",
"Caloneurodea",
"Coleoptera",
"Collembola",
"Dermaptera",
"Diaphanopterodea",
"Dictyoptera",
"Diplura",
"Diptera",
"Embioptera",
"Ephemeroptera",
"Glosselytrodea",
"Grylloblattodea",
"Hemiptera",
"Hymenoptera",
"Isoptera",
"Lepidoptera",
"Mallophaga",
"Mantophasmatodea",
"Mecoptera",
"Megaloptera",
"Megasecoptera",
"Miomoptera",
"Neuroptera",
"Odonata",
"Orthoptera",
"Palaeodictyoptera",
"Perielytrodea",
"Plecoptera",
"Protelytroptera",
"Protodonata",
"Protorthoptera",
"Protura",
"Psocoptera",
"Raphidioptera",
"Siphonaptera",
"Strepsiptera",
"Thysanoptera",
"Thysanura",
"Titanoptera",
"Trichoptera",
"Zoraptera",
"Anthracosauria",
"Ichthyostegalia",
"Temnospondyli",
"Aistopoda",
"Microsauria",
"Nectridea",
"Anura",
"Caudata",
"Gymnophiona",
"Aepyornithiformes",
"Alexornithiformes",
"Ambiortiformes",
"Anseriformes",
"Apodiformes",
"Apterygiformes",
"Archaeopterygiformes",
"Caprimulgiformes",
"Casuariiformes",
"Cathayornithiformes",
"Chaoyangiformes",
"Charadriiformes",
"Ciconiiformes",
"Coliiformes",
"Columbiformes",
"Confuciusornithiformes",
"Coraciiformes",
"Cuculiformes",
"Diatrymiformes",
"Falconiformes",
"Galliformes",
"Gansuiformes",
"Gaviiformes",
"Gobipterygiformes",
"Gruiformes",
"Hesperornithiformes",
"Iberomesornithiformes",
"Ichthyornithiformes",
"Liaoningornithiformes",
"Limnornithiformes",
"Lithornithiformes",
"Longipterygiformes",
"Omnivoropterygiformes",
"Palaeocursornithiformes",
"Passeriformes",
"Patagopterygiformes",
"Pelecaniformes",
"Piciformes",
"Podicipediformes",
"Praeornithiformes",
"Procellariiformes",
"Protoaviformes",
"Psittaciformes",
"Rheiformes",
"Sandcoleiformes",
"Sinosauropterygiformes",
"Sphenisciformes",
"Strigiformes",
"Struthioniformes",
"Tinamiformes",
"Trogoniformes",
"Yandangithformes",
"Yanornithiformes",
"Anagalida",
"Apatotheria",
"Artiodactyla",
"Asiadelphia",
"Astrapotheria",
"Ausktribosphenida",
"Carnivora",
"Cetacea",
"Chiroptera",
"Condylarthra",
"Creodonta",
"Dermoptera",
"Desmostylia",
"Dinocerata",
"Docodonta",
"Edentata",
"Embrithopoda",
"Eupantotheria",
"Hyracoidea",
"Insectivora",
"Lagomorpha",
"Leptictida",
"Litopterna",
"Macroscelidea",
"Marsupialia",
"Mesonychia",
"Monotremata",
"Multituberculata",
"Notopterna",
"Notoungulata",
"Pantodonta",
"Pantolesta",
"Perissodactyla",
"Pholidota",
"Primates",
"Proboscidea",
"Pyrotheria",
"Rodentia",
"Scandentia",
"Sirenia",
"Symmetrodonta",
"Taeniodonta",
"Tegotheridia",
"Tillodontia",
"Triconodonta",
"Tubulidentata",
"Volaticotheria",
"Xenungulata",
"Anaspidiformes",
"Cephalaspidiformes",
"Petromyzontiformes",
"Furcacaudiformes",
"Myxiniformes",
"Galeaspidiformes",
"Pteraspidiformes",
"Thelodontiformes",
"Carcharhiniformes",
"Cladodontiformes",
"Cladoselachiformes",
"Ctenacanthiformes",
"Heterodontiformes",
"Hexanchiformes",
"Hybodontiformes",
"Lamniformes",
"Lugalepidida",
"Mongolepidida",
"Myliobatiformes",
"Orectolobiformes",
"Pristiformes",
"Pristiophoriformes",
"Rajiformes",
"Squaliformes",
"Squatiniformes",
"Torpediniformes",
"Xenacanthiformes",
"Chimaeriformes",
"Chondrenchelyiformes",
"Copodontiformes",
"Edestiformes",
"Helodontiformes",
"Iniopterygiformes",
"Myriacanthiformes",
"Petalodontiformes",
"Psammodontiformes",
"Acipenseriformes",
"Albuliformes",
"Amiiformes",
"Anguilliformes",
"Aspidorhynchiformes",
"Atheriniformes",
"Aulopiformes",
"Batrachoidiformes",
"Beloniformes",
"Beryciformes",
"Cetomimiformes",
"Characiformes",
"Clupeiformes",
"Ctenothrissiformes",
"Cypriniformes",
"Cyprinodontiformes",
"Ellimmichthyiformes",
"Elopiformes",
"Gadiformes",
"Gasterosteiformes",
"Gobiesociformes",
"Gonorynchiformes",
"Guildayichthyiformes",
"Gymnotiformes",
"Haplolepidiformes",
"Ichthyodectiformes",
"Lampriformes",
"Lepisosteiformes",
"Leptolepidiformes",
"Lophiiformes",
"Luganoiiformes",
"Macrosemiiformes",
"Myctophiformes",
"Notacanthiformes",
"Ophidiiformes",
"Osteoglossiformes",
"Pachycormiformes",
"Palaeonisciformes",
"Pattersonichthyiformes",
"Peltopleuriformes",
"Perciformes",
"Percopsiformes",
"Perleidiformes",
"Phanerorhynchiformes",
"Pholidophoriformes",
"Pholidopleuriformes",
"Pleuronectiformes",
"Polypteriformes",
"Ptycholepiformes",
"Pycnodontiformes",
"Redfieldiiformes",
"Saccopharyngiformes",
"Salmoniformes",
"Saurichthyiformes",
"Scanilepiformes",
"Scorpaeniformes",
"Semionotiformes",
"Siluriformes",
"Sorbininardiformes",
"Stomiiformes",
"Synbranchiformes",
"Syngnathiformes",
"Tarrasiiformes",
"Tetraodontiformes",
"Zeiformes",
"Crossopterygii",
"Dipnoi",
"Cotylosauria",
"Mesosauria",
"Testudines",
"Crocodylia",
"Ornithischia",
"Pterosauria",
"Saurischia",
"Thecodontia",
"Araeoscelidia",
"Ichthyosauria",
"Placodontia",
"Sauropterygia",
"Eosuchia",
"Rhynchocephalia",
"Squamata",
"Pelycosauria",
"Therapsida",
"Actiniaria",
"Corallimorpharia",
"Heterocorallia",
"Hexanthiniaria",
"Kilbuchophyllida",
"Pentasmiliida",
"Rugosa",
"Scleractinia",
"Tabulata",
"Zoanthiniaria",
"Actinulida",
"Hydroida",
"Milleporina",
"Siphonophorida",
"Spongiomorphida",
"Stylasterina",
"Trachylinida",
"Protomedusae",
"Pholadomyoida",
"Hippuritoida",
"Myoida",
"Veneroida",
"Fordilloida",
"Glyptarcoidea",
"Modiomorphoida",
"Trigonioida",
"Unionoida",
"Nuculoida",
"Praecardioida",
"Solemyoida",
"Arcoida",
"Cyrtodontida",
"Limoida",
"Mytiloida",
"Ostreoida",
"Pterioida",
"Tuarangiida",
"Ammonitida",
"Anarcestida",
"Ceratitida",
"Clymeniida",
"Goniatitida",
"Lytoceratida",
"Meekoceratida",
"Otoceratida",
"Phylloceratida",
"Prolecanitida",
"Xenodiscida",
"Belemnitida",
"Boletzkyida",
"Octopoda",
"Sepiida",
"Teuthida",
"Vampyromorpha",
"Smeagolida",
"Soleolifera",
"Systellommatophora",
"Acochlidioidea",
"Anaspidea",
"Cephalaspidea",
"Gymnosomata",
"Notaspidea",
"Nudibranchia",
"Sacoglossa",
"Thecosomata",
"Archaeogastropoda",
"Mesogastropoda",
"Neogastropoda",
"Pyrifusoidea",
"Archaeopulmonata",
"Basommatophora",
"Stylommatophora",
"Mattheva",
"Merismoconchida",
"Bivalvulida",
"Multivalvulida",
"Karyorelictida",
"Pleurostomatida",
"Prostomatida",
"Apostomatida",
"Chonotrichida",
"Cyrtophorida",
"Nassulida",
"Rhynchodida",
"Synhymeniida",
"Suctorida",
"Colpodida",
"Entodiniomorphida",
"Trichostomatida",
"Astomatida",
"Hymenostomatida",
"Scuticociliatida",
"Hysterocinetida",
"Peritrichida",
"Heterotrichida",
"Hypotrichida",
"Odontostomatida",
"Oligotrichida",
"Chloromonadida",
"Chrysomonadida",
"Cryptomonadida",
"Dinoflagellida",
"Euglenida",
"Heterochlorida",
"Prasinomonadida",
"Prymnesiida",
"Silicoflagellida",
"Volvocida",
"Choanoflagellida",
"Diplomonadida",
"Hypermastigida",
"Kinetoplastida",
"Oxymonadida",
"Proteromonadida",
"Retortamonadida",
"Trichomonadida",
"Aconchulinida",
"Gromiida",
"Athalamida",
"Foraminiferida",
"Monothalamida",
"Amoebida",
"Schizopyrenida",
"Arcellinida",
"Himatismenida",
"Trichosida",
);


$names = array(
'Anoplura',
'Blattodea',
'Bolitophilidae',
'Collembola',
'Dermaptera',
'Diaphanopterodea',
'Embioptera',
'Ephemeroptera',
'Ephemeroptera',
'Isoptera',
'Mallophaga',
'Mecoptera',
'Mecoptera',
'Megaloptera',
'Megasecoptera',
'Miomoptera',
'Neuroptera',
'Neuroptera',
'Odonata',
'Palaeodictyoptera',
'Palaeodictyoptera',
'Palaeodictyoptera',
'Perielytrodea',
'Plecoptera',
'Protorthoptera',
'Protorthoptera',
'Protorthoptera',
'Psocoptera',
'Raphidioptera',
'Siphonaptera',
'Siphonaptera',
'Thysanoptera',
'Thysanura',
'Trichoptera',
'Trichoptera',
'Anoplura',
'Anoplura',
'Blattodea',
'Caloneurodea',
'Coelopidae',
'Collembola',
'Collembola',
'Collembola',
'Dermaptera',
'Dermaptera',
'Diaphanopterodea',
'Diaphanopterodea',
'Diplura',
'Diplura',
'Embioptera',
'Embioptera',
'Ephemeroptera',
'Ephemeroptera',
'Ephemeroptera',
'Glosselytrodea',
'Grylloblattodea',
'Isoptera',
'Isoptera',
'Mallophaga',
'Mallophaga',
'Mantodea',
'Mecoptera',
'Mecoptera',
'Megaloptera',
'Megaloptera',
'Megasecoptera',
'Megasecoptera',
'Miomoptera',
'Miomoptera',
'Neuroptera',
'Neuroptera',
'Odonata',
'Odonata',
'Odonata',
'Palaeodictyoptera',
'Palaeodictyoptera',
'Phasmida',
'Plecoptera',
'Plecoptera',
'Plecoptera',
'Protelytroptera',
'Protodonata',
'Protodonata',
'Protorthoptera',
'Protorthoptera',
'Protorthoptera',
'Protura',
'Psocoptera',
'Psocoptera',
'Raphidioptera',
'Saltatoria',
'Siphonaptera',
'Siphonaptera',
'Siphonaptera',
'Siphonaptera',
'Thysanoptera',
'Thysanoptera',
'Thysanoptera',
'Thysanoptera',
'Thysanura',
'Thysanura',
'Titanoptera',
'Titanoptera',
'Trichoptera',
'Trichoptera',
'Zoraptera',
'Odonata',
'Collembola',
);

$names = array(

"Adapidae",
"Aegialodontidae",
"Agaristidae",
"Alagomyidae",
"Ammonitida",
"Ammonoidea",
"Amphibia",
"Amphiboloidea",
"Amphichelydia",
"Amphicyonidae",
"Amphipoda",
"Amphisbaenia",
"Anagalida",
"Anapsida",
"Anguidae",
"Ankylosauria",
"Anobiidae",
"Anomura",
"Anoplotheriidae",
"Anoplura",
"Anthelidae",
"Anthicidae",
"Anthozoa",
"Anthracotheriidae",
"Anthribidae",
"Aplacophora",
"Aplodontidae",
"Arachnida",
"Araeoscelidia",
"Archaeogastropoda",
"Archosauria",
"Arcoida",
"Arctiidae",
"Articulata",
"Artiodactyla",
"Aspidogastrea",
"Astacura",
"Asteroidea",
"Astrapotheria",
"Aves",
"Bactritoidea",
"Balaenidae",
"Balanomorpha",
"Basilosauridae",
"Bathyergidae",
"Bathynellacea",
"Belemnitida",
"Bellerophontoidea",
"Bivalvia",
"Blastoidea",
"Blattodea",
"Boidae",
"Bolitophilidae",
"Bombycidae",
"Borhyaenidae",
"Bovidae",
"Brachiopoda",
"Brachyura",
"Bradypodidae",
"Branchiopoda",
"Bruchidae",
"Bryozoa",
"Buprestidae",
"Byrrhidae",
"Calanoida",
"Callithricidae",
"Caloneurodea",
"Calyptoptomatida",
"Camelidae",
"Canidae",
"Cantharidae",
"Carabidae",
"Carnivora",
"Castniidae",
"Castoridae",
"Caviidae",
"Cebidae",
"Cephalaspidea",
"Cephalochordata",
"Cephalopoda",
"Cerambycidae",
"Ceratitida",
"Ceratopsia",
"Cercopithecidae",
"Cervidae",
"Cestoda",
"Cetacea",
"Changlelestidae",
"Chelidae",
"Cheloniidae",
"Chinchillidae",
"Chiroptera",
"Chrysochloridae",
"Chrysomelidae",
"Ciidae",
"Cladocera",
"Clambidae",
"Cleridae",
"Clymeniida",
"Coccinellidae",
"Cocomyidae",
"Cocytiidae",
"Coelenterata",
"Coelopidae",
"Coleoidea",
"Coleoptera",
"Collembola",
"Collembolla",
"Colubridae",
"Colydiidae",
"Concentricycloidea",
"Conchostraca",
"Conchyliocarida",
"Condylarthra",
"Conodonta",
"Conularida",
"Copeognatha",
"Copepoda",
"Copromorphidae",
"Corylophidae",
"Cossidae",
"Cotylosauria",
"Creodonta",
"Cricoconarida",
"Crinoidea",
"Crocodylia",
"Crocodylidae",
"Crustacea",
"Cryptophagidae",
"Ctenocystoidea",
"Ctenodactylidae",
"Cucujidae",
"Cumacea",
"Curculionidae",
"Cyclocystoidea",
"Cyclopoida",
"Cynocephalidae",
"Dascillidae",
"Dasypodidae",
"Dasyproctidae",
"Delphinidae",
"Deltatheridiidae",
"Dermaptera",
"Dermoptera",
"Desmostylia",
"Diaphanopterodea",
"Dichobunidae",
"Dictyoptera",
"Didelphidae",
"Digenea",
"Dinilysiidae",
"Dinocerata",
"Dioptidae",
"Diplura",
"Dipodidae",
"Diprotodontidae",
"Diptera",
"Discolomidae",
"Donodontidae",
"Drepanidae",
"Drilidae",
"Dryopidae",
"Dugongidae",
"Dytiscidae",
"Echimyidae",
"Echinodermata",
"Echinoidea",
"Edentata",
"Edrioasteroidea",
"Elachistidae",
"Elateridae",
"Elephantidae",
"Emballonuridae",
"Embioptera",
"Embrithopoda",
"Endomychidae",
"Eocrinoidea",
"Eomyidae",
"Eosimiidae",
"Eosuchia",
"Ephemeroptera",
"Epiplemidae",
"Equidae",
"Erinaceidae",
"Erotylidae",
"Eucnemidae",
"Eupantotheria",
"Eupterotidae",
"Euryapsida",
"Euthycarcinoidea",
"Eutypomyidae",
"Felidae",
"Gastrochaenoidea",
"Gastropoda",
"Gekkonidae",
"Gelechiidae",
"Geometridae",
"Geotrupidae",
"Gliridae",
"Glosselytrodea",
"Glyptodontidae",
"Gondwanatheriidae",
"Goniatitida",
"Graptolithina",
"Grylloblattodea",
"Gyrinidae",
"Haliplidae",
"Harpacticoida",
"Helicoplacoidea",
"Heliodinidae",
"Helotidae",
"Hemiptera",
"Hepialidae",
"Hesperiidae",
"Heterobranchia",
"Heteropoda",
"Hippopotamidae",
"Histeridae",
"Holothuroidea",
"Homoiostelea",
"Homostelea",
"Hyaenidae",
"Hydrochaeridae",
"Hydrophilidae",
"Hylobatidae",
"Hymenoptera",
"Hyracodontidae",
"Hyracoidea",
"Ichthyosauria",
"Inarticulata",
"Incurvariidae",
"Insecta",
"Insectivora",
"Isectolophidae",
"Isopoda",
"Isoptera",
"Lacertidae",
"Lagomorpha",
"Lampyridae",
"Laredomyidae",
"Lasiocampidae",
"Lathridiidae",
"Lemuridae",
"Lepadomorpha",
"Lepidoptera",
"Lepidosauria",
"Leporidae",
"Leptictida",
"Leptidoptera",
"Limacodidae",
"Litopterna",
"Lucanidae",
"Lycaenidae",
"Lycidae",
"Lymantriidae",
"Lyonetiidae",
"Lytoceratida",
"Macropodidae",
"Macroscelidea",
"Malacostraca",
"Mallophaga",
"Mammalia",
"Mantodea",
"Marsupialia",
"Mayulestidae",
"Mecoptera",
"Megalonychidae",
"Megaloptera",
"Megasecoptera",
"Megatheriidae",
"Melandryidae",
"Meloidae",
"Melyridae",
"Membracidae",
"Merostomata",
"Mesosauria",
"Metacheiromyidae",
"Microsyopidae",
"Mingotheriidae",
"Miomoptera",
"Modiomorphoida",
"Mollusca",
"Molossidae",
"Monodontidae",
"Monogenea",
"Monommidae",
"Monoplacophora",
"Monotremata",
"Monstrilloida",
"Mordellidae",
"Multituberculata",
"Muridae",
"Mustelidae",
"Mylagaulidae",
"Mylodontidae",
"Myriapoda",
"Mysidacea",
"Mystacocarida",
"Natalidae",
"Natantia",
"Nautiloidea",
"Nematoda",
"Nemertinea",
"Neuroptera",
"Nitidulidae",
"Noctilionidae",
"Noctuidae",
"Nolidae",
"Notaspidea",
"Notodontidae",
"Notopterna",
"Notoryctidae",
"Notoungulata",
"Nudibranchia",
"Nycteridae",
"Nymphalidae",
"Ochotonidae",
"Octodontidae",
"Odobenidae",
"Odobenocetopsidae",
"Odonata",
"Oecophoridae",
"Oedemeridae",
"Omomyidae",
"Ophiocistioidea",
"Ophiuroidea",
"Ornithischia",
"Ornithopoda",
"Ornithorhynchidae",
"Orogomyidae",
"Orthoptera",
"Ostracoda",
"Ostreoida",
"Otariidae",
"Palaeodictyoptera",
"Palaeotheriidae",
"Palinura",
"Pantodonta",
"Pantolesta",
"Pantopoda",
"Papilionidae",
"Parablastoidea",
"Paracrinoidea",
"Parapithecidae",
"Paraplecoptera",
"Paromomyidae",
"Passalidae",
"Pedetidae",
"Pelycosauria",
"Peramelidae",
"Perielytrodea",
"Perissodactyla",
"Petauridae",
"Phalacridae",
"Phalangeridae",
"Phascolarctidae",
"Phasmida",
"Philisidae",
"Phocidae",
"Pholidota",
"Phyllocarida",
"Phylloceratida",
"Phyllostomidae",
"Physeteridae",
"Pieridae",
"Pisces",
"Platanistidae",
"Platyhelminthes",
"Platypodidae",
"Plecoptera",
"Pleurotomarioidea",
"Plutellidae",
"Polyplacophora",
"Pongidae",
"Porifera",
"Primates",
"Proboscidea",
"Prosobranchia",
"Protelytroptera",
"Protista",
"Protocetidae",
"Protodonata",
"Protohymenoptera",
"Protoperlaria",
"Protorthoptera",
"Protostegidae",
"Protosuchia",
"Protura",
"Pselaphidae",
"Psocoptera",
"Psychidae",
"Pterodactyloidea",
"Pterophoridae",
"Pteropodidae",
"Pterosauria",
"Ptilodactylidae",
"Ptinidae",
"Pulmonata",
"Pyralidae",
"Pyraloidea",
"Pyrochroidae",
"Pyrotheria",
"Pythidae",
"Raphidioptera",
"Remipedia",
"Reptilia",
"Rhinolophidae",
"Rhipiphoridae",
"Rhizocephala",
"Rhombifera",
"Rhynchocephalia",
"Rodentia",
"Rostroconchia",
"Salpingidae",
"Saltatoria",
"Saturniidae",
"Sauria",
"Saurischia",
"Sauropodomorpha",
"Sauropterygia",
"Scaphopoda",
"Scarabaeidae",
"Scincidae",
"Sciuridae",
"Scydmaenidae",
"Sepiida",
"Serpentes",
"Sesiidae",
"Silphidae",
"Siphonaptera",
"Siphonostomatoida",
"Sirenia",
"Somasteroidea",
"Soricidae",
"Sphaeritidae",
"Sphingidae",
"Staphylinidae",
"Stomatopoda",
"Stylophora",
"Suidae",
"Symmetrodonta",
"Synapsida",
"Tachyglossidae",
"Taeniodonta",
"Talpidae",
"Tanaidacea",
"Tantulocarida",
"Tapiridae",
"Tayassuidae",
"Tegotheridia",
"Tenebrionidae",
"Tenrecidae",
"Testudines",
"Teuthida",
"Thecodontia",
"Therapsida",
"Theridomyidae",
"Thermosbaenacea",
"Theropoda",
"Theroteinidae",
"Thyatiridae",
"Thyrididae",
"Thysanoptera",
"Thysanura",
"Tillodontia",
"Tineidae",
"Tineodidae",
"Titanoptera",
"Todralestidae",
"Tortricidae",
"Tragulidae",
"Trichechidae",
"Trichoptera",
"Triconodonta",
"Trilobita",
"Trionychidae",
"Trogidae",
"Tubulidentata",
"Tunicata",
"Typhlopidae",
"Uraniidae",
"Verrucomorpha",
"Vespertilionidae",
"Viverravidae",
"Viverridae",
"Waipatiidae",
"Xiphosura",
"Yingabalanaridae",
"Zapodidae",
"Zegdoumyidae",
"Ziphiidae",
"Zoraptera",
"Zygaenidae",
);

/*
$names = array(
'Pisces',
'Reptilia',
'Echinodermata',
'Bryozoa',

);
*/


$names = array(
'Characidae',
);




function get_image_filename($base_dir, $name, $extension = 'svg')
{
	$image_filename = '';

	$prefix = substr($name, 0, 1);	
	$destination_dir = $base_dir . '/' . $prefix;
	$filename = $destination_dir . '/' . $name . '.' . $extension; 
	
	if (file_exists($filename))
	{
		$image_filename = $filename;
	}
	
	return $image_filename;

}

function get_json_filename($base_dir, $name, $extension = 'svg')
{
	$prefix = substr($name, 0, 1);	
	$destination_dir = $base_dir . '/' . $prefix;
	
	$destination_dir = $base_dir . '/' . $prefix;
	
	if (!file_exists($destination_dir))
	{
		$oldumask = umask(0); 
		mkdir($destination_dir, 0777);
		umask($oldumask);
	}

	
	$json_filename = $destination_dir . '/' . $name . '.' . $extension . '.json'; 
	return $json_filename;
}


function create_image_filename($base_dir, $name, $extension = 'svg')
{
	$image_filename = '';

	$prefix = substr($name, 0, 1);
	
	$destination_dir = $base_dir . '/' . $prefix;
	
	if (!file_exists($destination_dir))
	{
		$oldumask = umask(0); 
		mkdir($destination_dir, 0777);
		umask($oldumask);
	}
	
	$image_filename = $destination_dir . '/' . $name  . '.' . $extension; 
	
	return $image_filename;

}


$base_dir = dirname(__FILE__) . '/images';

foreach ($names as $name)
{
	echo "$name\n";
	
	$ok = false;
	
	$image_filename = get_image_filename($base_dir, $name, 'svg');
		
	if (file_exists($image_filename))
	{
		$ok = true;
	}
	else
	{
		$image_filename = get_image_filename($base_dir, $name, 'png');	
		if (file_exists($image_filename))
		{
			$ok = true;
		}		
	}
	
	if ($ok)
	{
		echo $image_filename . "\n";
	}
	else
	{
		$image_url = '';
		$image_type = '';

		// name search 
		$url = 'http://phylopic.org/api/a/name/search' . '?text=' . urlencode($name);

		$json = get($url);
	
		//echo $json;
	
		if ($json != '')
		{	
			$image_type = '';
	
			$obj = json_decode($json);
		
		
			if (count($obj->result) > 0)
			{
				$uid = $obj->result[0]->canonicalName->uid;
		
			
				// Try for SVG first
				$url = 'http://phylopic.org/api/a/name/' . $uid . '/images?options=svgFile';

				$json = get($url);
								
				file_put_contents(get_json_filename($base_dir, $name, 'svg'), $json);
		
				$obj = json_decode($json);
		
				//print_r($obj);
		
				if ($image_url == '')
				{
					if (count($obj->result->same) > 0)
					{
						if (isset($obj->result->same[0]->svgFile))
						{
							$image_url = 'http://phylopic.org' . $obj->result->same[0]->svgFile->url;						
							$image_type = 'svg';
						}
					}
				}
		
				if ($image_url == '')
				{
					if (count($obj->result->supertaxa) > 0)
					{
						if (isset($obj->result->supertaxa[0]->svgFile))
						{
							$image_url = 'http://phylopic.org' . $obj->result->supertaxa[0]->svgFile->url;
						
							$image_type = 'svg';
						}
					}
				}
			
				if ($image_url != '')
				{
					$filename = create_image_filename($base_dir, $name, $image_type);
					file_put_contents($filename, get($image_url));
				}
			
			
				$image_url = '';
				$image_type = '';
		
				// No SVG, try PNG
				if ($image_url == '')
				{
		
					$url = 'http://phylopic.org/api/a/name/' . $uid . '/images?options=pngFiles';
		
					$json = get($url);
					
					file_put_contents(get_json_filename($base_dir, $name, 'png'), $json);
							
					$obj = json_decode($json);
		
					// print_r($obj);
		
					if ($image_url == '')
					{
						if (count($obj->result->same) > 0)
						{
							$image_url = 'http://phylopic.org' . $obj->result->same[0]->pngFiles[0]->url;
						
							$image_type = 'png';
						}
					}
		
					if ($image_url == '')
					{
						if (count($obj->result->supertaxa) > 0)
						{
							$image_url = 'http://phylopic.org' . $obj->result->supertaxa[0]->pngFiles[0]->url;
						
							$image_type = 'png';
						}
					}
				}
			
			
				if ($image_url != '')
				{
					$filename = create_image_filename($base_dir, $name, $image_type);
					file_put_contents($filename, get($image_url));
				}
					
			}
		}
	}

}



?>