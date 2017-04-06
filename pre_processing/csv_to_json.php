<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>04cleanfurther</title>
</head>
<body>
<?php
header('Content-Type: text/plain');
$arr = array("gossipcenter","justjared","news","tweets");
$h = array('category','content');
$common = array('able','about','above','abroad','according','accordingly','across','actually','adj','after','afterwards','again','against','ago','ahead','ain t','ain\'t','all','allow','allows','almost','alone','along','alongside','already','also','although','always','am','amid','amidst','among','amongst','an','and','another','any','anybody','anyhow','anyone','anything','anyway','anyways','anywhere','apart','appear','appreciate','appropriate','are','aren t','aren\'t','around','as','a\'s','aside','ask','asking','associated','at','available','away','awfully', 'back','backward','backwards','be','became','because','become','becomes','becoming','been','before','beforehand','begin','behind','being','believe','below','beside','besides','best','better','between','beyond','both','brief','but','by', 'came','can','cannot','cant','can t','can\'t','caption','cause','causes','certain','certainly','changes','clearly','c mon','c\'mon','co','co.','com','come','comes','concerning','consequently','consider','considering','contain','containing','contains','corresponding','could','couldn t','couldn\'t','course','c\'s','currently', 'dare','daren t','daren\'t','definitely','described','despite','did','didn t','didn\'t','different','directly','do','does','doesn t','doesn\'t','doing','done','don t','don\'t','down','downwards','during', 'each','edu','eg','eight','eighty','either','else','elsewhere','end','ending','enough','entirely','especially','et','etc','even','ever','evermore','every','everybody','everyone','everything','everywhere','ex','exactly','example','except', 'fairly','far','farther','few','fewer','fifth','first','five','followed','following','follows','for','forever','former','formerly','forth','forward','found','four','from','further','furthermore', 'get','gets','getting','given','gives','go','goes','going','gone','got','gotten','greetings', 'had','hadn t','hadn\'t','half','happens','hardly','has','hasn t','hasn\'t','have','haven t','haven\'t','having','he','he d','he\'d','he ll','he\'ll','hello','help','hence','her','here','hereafter','hereby','herein','here s','here\'s','hereupon','hers','herself','he s','he\'s','hi','him','himself','his','hither','hopefully','how','howbeit','however','hundred', 'i\'d','ie','if','ignored','i ll','i\'ll','i\'m','immediate','in','inasmuch','inc','inc.','indeed','indicate','indicated','indicates','inner','inside','insofar','instead','into','inward','is','isn t','isn\'t','it','it d','it\'d','it ll','it\'ll','its','it s','it\'s','itself','i ve','i\'ve', 'just', 'keep','keeps','kept','know','known','knows', 'last','lately','later','latter','latterly','least','less','lest','let','let s','let\'s','like','liked','likely','likewise','little','lol','look','looking','looks','low','lower','ltd', 'made','mainly','make','makes','many','may','maybe','mayn t','mayn\'t','me','mean','meantime','meanwhile','merely','might','mightn t','mightn\'t','mine','minus','miss','more','moreover','most','mostly','mr','mrs','much','must','mustn t','mustn\'t','my','myself', 'name','namely','nd','near','nearly','necessary','need','needn t','needn\'t','needs','neither','never','neverf','neverless','nevertheless','new','next','nine','ninety','no','nobody','non','none','nonetheless','noone','no-one','nor','normally','not','nothing','notwithstanding','novel','now','nowhere', 'obviously','of','off','often','oh','ok','okay','old','on','once','one','ones','one s','one\'s','only','onto','opposite','or','other','others','otherwise','ought','oughtn t','oughtn\'t','our','ours','ourselves','out','outside','over','overall','own', 'particular','particularly','past','per','perhaps','placed','please','plus','possible','presumably','probably','provided','provides', 'que','quite','qv', 'rather','rd','re','really','reasonably','recent','recently','regarding','regardless','regards','relatively','respectively','right','round','rt','said','same','saw','say','saying','says','second','secondly','see','seeing','seem','seemed','seeming','seems','seen','self','selves','sensible','sent','serious','seriously','seven','several','shall','shan t','shan\'t','she','she d','she\'d','she ll','she\'ll','she s','she\'s','should','shouldn t','shouldn\'t','since','six','so','some','somebody','someday','somehow','someone','something','sometime','sometimes','somewhat','somewhere','soon','sorry','specified','specify','specifying','still','sub','such','sup','sure', 'take','taken','taking','tell','tends','th','than','thank','thanks','thanx','that','that ll','that\'ll','thats','that s','that\'s','that ve','that\'ve','the','their','theirs','them','themselves','then','thence','there','thereafter','thereby','there d','there\'d','therefore','therein','there ll','there\'ll','there re','there\'re','theres','there s','there\'s','thereupon','there ve','there\'ve','these','they','they d','they\'d','they ll','they\'ll','they re','they\'re','they ve','they\'ve','thing','things','think','third','thirty','this','thorough','thoroughly','those','though','three','through','throughout','thru','thus','till','to','together','too','took','toward','towards','tried','tries','truly','try','trying','t\'s','twice','two', 'un','under','underneath','undoing','unfortunately','unless','unlike','unlikely','until','unto','up','upon','upwards','us','use','used','useful','uses','using','usually', 'value','various','versus','very','via','viz','vs', 'want','wants','was','wasn t','wasn\'t','way','we','we d','we\'d','welcome','well','we ll','we\'ll','went','were','we re','we\'re','weren t','weren\'t','we ve','we\'ve','what','whatever','what ll','what\'ll','what s','what\'s','what ve','what\'ve','when','whence','whenever','where','whereafter','whereas','whereby','wherein','where s','where\'s','whereupon','wherever','whether','which','whichever','while','whilst','whither','who','who d','who\'d','whoever','whole','who ll','who\'ll','whom','whomever','who s','who\'s','whose','why','will','willing','wish','with','within','without','wonder','won t','won\'t','would','wouldn t','wouldn\'t', 'yes','yet','you','you d','you\'d','you ll','you\'ll','your','you re','you\'re','yours','yourself','yourselves','you ve','you\'ve','zero');

$consolidated = fopen("cleaned/consolidated.csv", 'w');
for ($i=0;$i<4;$i++){
    $file = $arr[$i];

    $data = $file.".csv";
    $cleaned = .$file.".csv";

    $csv = array_map('str_getcsv', file($data));
    $fp = fopen($cleaned, 'w');
    foreach($csv as $k=>$v) {
        $newstr = $v[1];
        $newstr = strtolower($newstr); //convert to lowercase
        $newstr = preg_replace('/\b('.implode('|',$common).')\b/','',$newstr); //remove stopwords
        $newstr = htmlspecialchars_decode($newstr);
        $newstr = html_entity_decode($newstr);
        $newstr = preg_replace('/\b(https?|http|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', ' ', $newstr); //remove url
        $newstr = preg_replace('/\r\n|\n|\r/', ' ', $newstr);
        $newstr = str_replace(array('\n','\t','\u00a0'), ' ', $newstr);
        $newstr = transliterator_transliterate('Any-Latin; Latin-ASCII; [\u0100-\u7fff] remove',$newstr); //convert accents
        $newstr = stripslashes($newstr);
        $newstr = strip_tags($newstr); //remove all html tags
        $newstr = preg_replace('/[^A-Za-z0-9]/', ' ', $newstr); //remove non alphanumeric characters
        $newstr = preg_replace('/\b('.implode('|',$common).')\b/','',$newstr); //remove stopwords again
        $newstr = preg_replace('/\b[a-z]\b/','',$newstr); //remove individual alpha characters
        //remove extra spaces
        $newstr = preg_replace('/\s+/S', ' ', $newstr);
        $newstr = preg_replace('!\s+!', ' ', $newstr);
        $newstr = preg_replace('/ +/', ' ', $newstr);
        $newstr = trim($newstr);

        if ($newstr!="") {
            $v[1] = $newstr;
            fputcsv($fp, $v);
            if(!($k==0 && $i!=0))fputcsv($consolidated, $v);
        }
    }
    fclose($fp);
    echo "success ".$file;
    echo '<br/><br/>';
}
fclose($consolidated);
?>
</body>
</html>