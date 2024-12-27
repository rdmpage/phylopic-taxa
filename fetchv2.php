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



$names=array('Ixodida');

$names=array(

'Alpheidae',
'Atyidae',
'Bathypalaemonellidae',
'Benthesicymidae',
'Cambaridae',
'Diogenidae',
'Dromiidae',
'Epialtidae',
'Galatheidae',
'Gecarcinucidae',
'Hippidae',
'Hippolytidae',
'Homolodromiidae',
'Hymenosomatidae',
'Necrocarcinidae',
'Nephropidae',
'Ocypodidae',
'Oplophoridae',
'Paguridae',
'Palaemonidae',
'Parastacidae',
'Penaeidae',
'Pinnotheridae',
'Porcellanidae',
'Potamidae',
'Potamonautidae',
'Sergestidae',
'Sesarmidae',
'Stenopodidae',

);

$names = array(
'Nemertea',
'Orthonectida',

'Archaeognatha',
'Blattodea',
'Caloneurodea',
'Cnemidolestodea',
'Coleoptera',
'Dermaptera',
'Diaphanopterodea',
'Diptera',
'Embioptera',
'Eoblattida',
'Ephemeroptera',
'Glosselytrodea',
'Grylloblattodea',
'Hemiptera',
'Hymenoptera',
'Hypoperlida',
'Lepidoptera',
'Mantodea',
'Mantophasmatodea',
'Mecoptera',
'Megaloptera',
'Meganisoptera',
'Megasecoptera',
'Miomoptera',
'Neuroptera',
'Odonata',
'Orthoptera',
'Palaeodictyoptera',
'Paoliida',
'Phasmida',
'Plecoptera',
'Protocoleoptera',
'Protorthoptera',
'Psocodea',
'Raphidioptera',
'Reculoidea',
'Siphonaptera',
'Strepsiptera',
'Thysanoptera',
'Titanoptera',
'Trichoptera',
'Zoraptera',
'Zygentoma',

);


$names = array(
'Andesianoidea',
'Bombycoidea',
'Calliduloidea',
'Carposinoidea',
'Choreutoidea',
'Cossoidea',
'Drepanoidea',
'Epermenioidea',
'Eriocranioidea',
'Galacticoidea',
'Gelechioidea',
'Geometroidea',
'Gracillarioidea',
'Hepialoidea',
'Heterobathmioidea',
'Hyblaeoidea',
'Immoidea',
'Lasiocampoidea',
'Lophocoronoidea',
'Micropterigoidea',
'Mimallonoidea',
'Neopseustoidea',
'Nepticuloidea',
'Noctuoidea',
'Palaephatoidea',
'Papilionoidea',
'Pterophoroidea',
'Pyraloidea',
'Schreckensteinioidea',
'Simaethistoidea',
'Thyridoidea',
'Tineoidea',
'Tischerioidea',
'Tortricoidea',
'Urodoidea',
'Whalleyanoidea',
'Yponomeutoidea',
'Zygaenoidea'

);



$names = array(
/*
'Blaberidae',
'Blattidae',
'Ectobiidae',
'Termitidae',
'Mastotermitidae',*/
'Astigmata',
'Opilioacarida',
'Xenodermidae',
);




$names = array('Aeschnidiidae','Aeshnidae','Calopterygidae','Chlorocyphidae','Coenagrionidae','Gomphidae','Libellulidae','Platycnemididae','Polythoridae','Protoneuridae');

$names = array('Zingiberales');

$names = array('Acorales','Alismatales','Arecales','Asparagales','Commelinales','Dioscoreales','Liliales','Pandanales','Petrosaviales','Poales','Polygonatum','Tillandsia','Zingiberales');

$names=array(
'Acanthobdellida','Arhynchobdellida','Barbronia','Crassiclitellata','Enchytraeida','Haplotaxida','Moniligastrida','Opisthopora','Rhynchobdellida'
);

$names=array('Acanthaspidiidae','Agnaridae','Anthuridae','Armadillidae','Armadillidiidae','Asellidae','Austrarcturellidae','Berytoniscidae','Bopyridae','Cirolanidae','Corallanidae','Cymothoidae','Entoniscidae','Gnathiidae','Janiridae','Joeropsididae','Ligiidae','Munnopsidae','Nannoniscidae','Paramunnidae','Paranthuridae','Philosciidae','Platyarthridae','Porcellionidae','Sphaeromatidae','Stenasellidae','Styloniscidae','Trichoniscidae');


$names = array(
'Echinodermata',
'Hemichordata',
'Cephalochordata',
'Tunicata',
'Cyclostomata',
'Chondrichthyes',
'Actinopterygii',
'Sarcopterygii',
'Amphibia',
'Lepidosauria',
'Testudines',
'Crocodylia',
'Aves',
'Mammalia',
'Porifera',
'Cnidaria',
'Ctenophora',
'Acanthocephala',
'Brachiopoda',
'Bryozoa',
'Gastrotricha',
'Platyhelminthes',
'Annelida',
'Sipuncula',
'Mollusca',
'Nemertea',
'Chaetognatha',
'Rotifera',
'Kinorhyncha',
'Nematomorpha',
'Nematoda',
'Tardigrada',
'Onychophora',
'Arthropoda',
'Arachnida',
'Pycnogonida',
'Chilopoda',
'Diplopoda',
'Malacostraca',
'Ostracoda',
'Collembola',
'Blattodea',
'Insecta',
'Archaeognatha',
'Diptera',
'Coleoptera',
'Dermaptera',
'Embioptera',
'Ephemeroptera',
'Hemiptera',
'Hymenoptera',
'Lepidoptera',
'Mantodea',
'Mecoptera',
'Megaloptera',
'Neuroptera',
'Odonata',
'Orthoptera',
'Phasmatodea',
'Plecoptera',
'Psocodea',
'Raphidioptera',
'Siphonaptera',
'Strepsiptera',
'Thysanoptera',
'Trichoptera',
'Apidae',
'Formicidae',
'Vespidae',
'Culicidae',
'Drosophilidae',
'Geometridae',
'Lycaenidae',
'Noctuidae',
'Nymphalidae',
'Papilionidae',
'Pieridae',
'Pyralidae',
'Saturniidae',
'Sphingidae',
'Uraniidae',
'Chordata',
'Rhodophyta',
'Chlorophyta',
'Bryophyta',
'Lycopodiophyta',
'Pteridophyta',
'Pinophyta',
'Magnoliophyta',
'Magnoliophyta',
);

$names=array(
'Bothriuridae',
'Buthidae',
'Diplocentridae',
'Euscorpiidae',
'Iuridae',
'Pseudochactidae',
'Scorpionidae',
'Scorpiopidae',
'Troglotayosicidae',
'Vaejovidae',
);

//----------------------------------------------------------------------------------------
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

//----------------------------------------------------------------------------------------
function get_json_filename($base_dir, $name)
{
	$prefix = substr($name, 0, 1);	
	$destination_dir = $base_dir . '/' . $prefix;
	
	if (!file_exists($destination_dir))
	{
		$oldumask = umask(0); 
		mkdir($destination_dir, 0777);
		umask($oldumask);
	}
	
	$json_filename = $destination_dir . '/' . $name  . '.json'; 
	return $json_filename;
}


//----------------------------------------------------------------------------------------
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

//----------------------------------------------------------------------------------------

$base_dir = dirname(__FILE__) . '/images';

$build = 262;
$build = 354;
$build = 372;
$build = 396;
$build = 402;
$build = 454;
$build = 455;

$count = 1;

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
		echo "We have this already: $image_filename\n";
	}
	else
	{
		$image_url = '';
		$image_type = '';

		// name search 
		$url = 'https://api.phylopic.org/nodes?build=' . $build . '&filter_name=' . urlencode(strtolower($name)) . '&page=0';
		
		$json = get($url);
	
		echo $json;
		
		echo $url . "\n";
	
		if ($json != '')
		{	
			$image_type = '';
	
			$obj = json_decode($json);
			
			if (isset($obj->_links->items[0]))
			{
				$url = 'https://api.phylopic.org/' . $obj->_links->items[0]->href . '&embed_primaryImage=true';

				$json = get($url);
				
				$filename = get_json_filename($base_dir, $name);
				file_put_contents($filename, $json);
				
				$image_obj = json_decode($json);
				
				print_r($image_obj);
				
				$image_url = '';
				
				if (isset($image_obj->_embedded->primaryImage->_links))
				{
					if (isset($image_obj->_embedded->primaryImage->_links->thumbnailFiles))
					{
						$image_url = $image_obj->_embedded->primaryImage->_links->thumbnailFiles[0]->href;						
						$image_type = str_replace('image/', '', $image_obj->_embedded->primaryImage->_links->thumbnailFiles[0]->type);

						$filename = create_image_filename($base_dir, $name, $image_type);
						file_put_contents($filename, get($image_url));
					}

					if (isset($image_obj->_embedded->primaryImage->_links->vectorFile))
					{
						$image_url = $image_obj->_embedded->primaryImage->_links->vectorFile->href;						
						$image_type = str_replace('image/', '', $image_obj->_embedded->primaryImage->_links->vectorFile->type);
						$image_type = str_replace('+xml', '', $image_type);

						$filename = create_image_filename($base_dir, $name, $image_type);
						file_put_contents($filename, get($image_url));
					}
				}					
			}
		}
		
		
		// Give server a break every 10 items
		if (($count++ % 10) == 0)
		{
			$rand = rand(1000000, 3000000);
			echo "\n ...sleeping for " . round(($rand / 1000000),2) . ' seconds' . "\n\n";
			usleep($rand);
		}
		
		
	}

}



?>