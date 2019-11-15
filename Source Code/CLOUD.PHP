<?php
#session_start();
/* array sort helper function */
function randomSort($a, $b)
{
    return rand(-1, 1);
}
	
class PTagCloud
{
	var $m_arTags = array();
	
	//custom parameters
	var $m_displayedElementsCount;
	var $m_searchURL; 
	var $m_backgroundImage;
	var $m_backgroundColor;
	var $m_width;
	var $m_arColors;
	var $m_bUTF8;
	
	function __construct($displayedElementCount, $arSeedWords = false)
	{
	    $this->m_displayedElementsCount = $displayedElementCount;
	    $this->m_searchURL = "http://www.google.com/search?hl=en&q=";
	    $this->m_bUTF8 = false;
	    $this->m_backgroundColor = "#000";
	    $this->m_arColors[0] = "#5122CC";
	    $this->m_arColors[1] = "#229926";
	    $this->m_arColors[2] = "#330099";
	    $this->m_arColors[3] = "#819922";
	    $this->m_arColors[4] = "#22CCC3";
	    $this->m_arColors[5] = "#99008D";
	    $this->m_arColors[6] = "#943131";
	    $this->m_arColors[7] = "#B23B3B";
	    $this->m_arColors[8] = "#229938";
	    $this->m_arColors[9] = "#419922";
	    
		if ($arSeedWords !== false && is_array($arSeedWords))
		{
			foreach ($arSeedWords as $key => $value)
			{
				$this->addTag($value);
			}
		}
	}
	 
	function PTagCloud($displayedElementCount, $arSeedWords = false)
	{
		$this->__construct($displayedElementCount, $arSeedWords);
	}
	
	function setSearchURL($searchURL)
	{
	    $this->m_searchURL = $searchURL;
	}

	function setUTF8($bUTF8)
	{
	    $this->m_bUTF8 = $bUTF8;
	}

	function setWidth($width)
	{
	    $this->m_width = $width;
	}

	function setBackgroundImage($backgroundImage)
	{
	    $this->m_backgroundImage = $backgroundImage;
	}

	function setBackgroundColor($backgroundColor)
	{
	    $this->m_backgroundColor = $backgroundColor;
	}
	
	function setTextColors($arColors)
	{
	    $this->m_arColors = $arColors;
	}
	 
	/* word replace helper */
    function str_replace_word($needle, $replacement, $haystack)
    {
        $pattern = "/\b$needle\b/i";
        $haystack = preg_replace($pattern, $replacement, $haystack);
        return $haystack;
    }

    function keywords_extract($text)
    {
        $text = strtolower($text);
        $text = strip_tags($text);
      
        /* 
         * Handle common words first because they have punctuation and we need to remove them
         * before removing punctuation.
         */
        $stopWords = array("a", "about", "above", "above", "across", "after", "afterwards", "again", "against", "all",
            "almost", "alone", "along", "already", "also","although","always","am","among", "amongst", "amoungst", "amount", 
            "an", "and", "another", "any","anyhow","anyone","anything","anyway", "anywhere", "are", "around", "as",  "at", "back",
            "be","became", "because","become","becomes", "becoming", "been", "before", "beforehand", "behind", "being", "below", "beside", 
            "besides", "between", "beyond", "bill", "both", "bottom","but", "by", "call", "can", "cannot", "cant", "co", "con", "could", 
            "couldnt", "cry", "de", "describe", "detail", "do", "done", "down", "due", "during", "each", "eg", "eight", "either", "eleven",
            "else", "elsewhere", "empty", "enough", "etc", "even", "ever", "every", "everyone", "everything", "everywhere", "except", "few", 
            "fifteen", "fify", "fill", "find", "fire", "first", "five", "for", "former", "formerly", "forty", "found", "four", "from", "front", 
            "full", "further", "get", "give", "go", "had", "has", "hasnt", "have", "he", "hence", "her", "here", "hereafter", "hereby", "herein",
            "hereupon", "hers", "herself", "him", "himself", "his", "how", "however", "hundred", "ie", "if", "in", "inc", "indeed", "interest", 
            "into", "is", "it", "its", "itself", "keep", "last", "latter", "latterly", "least", "less", "ltd", "made", "many", "may", "me", 
            "meanwhile", "might", "mill", "mine", "more", "moreover", "most", "mostly", "move", "much", "must", "my", "myself", "name", "namely",
            "neither", "never", "nevertheless", "next", "nine", "no", "nobody", "none", "noone", "nor", "not", "nothing", "now", "nowhere", "of",
            "off", "often", "on", "once", "one", "only", "onto", "or", "other", "others", "otherwise", "our", "ours", "ourselves", "out", "over", 
            "own","part", "per", "perhaps", "please", "put", "rather", "re", "same", "see", "seem", "seemed", "seeming", "seems", "serious", "several", 
            "she", "should", "show", "side", "since", "sincere", "six", "sixty", "so", "some", "somehow", "someone", "something", "sometime", "sometimes", 
            "somewhere", "still", "such", "system", "take", "ten", "than", "that", "the", "their", "them", "themselves", "then", "thence", "there", 
            "thereafter", "thereby", "therefore", "therein", "thereupon", "these", "they", "thickv", "thin", "third", "this", "those", "though", "three", 
            "through", "throughout", "thru", "thus", "to", "together", "too", "top", "toward", "towards", "twelve", "twenty", "two", "un", "under", "until",
            "up", "upon", "us", "very", "via", "was", "we", "well", "were", "what", "whatever", "when", "whence", "whenever", "where", "whereafter", 
            "whereas", "whereby", "wherein", "whereupon", "wherever", "whether", "which", "while", "whither", "who", "whoever", "whole", "whom", "whose", 
            "why", "will", "with", "within", "without", "would", "yet", "you", "your", "yours", "yourself", "yourselves", "the");
        
        $commonWords = "'tis,'twas,a,able,about,across,after,ain't,all,almost,also,am,among,an,and,any,are,aren't," .
            "as,at,be,because,been,but,by,can,can't,cannot,could,could've,couldn't,dear,did,didn't,do,does,doesn't," .
            "don't,either,else,ever,every,for,from,get,got,had,has,hasn't,have,he,he'd,he'll,he's,her,hers,him,his," .
            "how,how'd,how'll,how's,however,i,i'd,i'll,i'm,i've,if,in,into,is,isn't,it,it's,its,just,least,let,like," .
            "likely,may,me,might,might've,mightn't,most,must,must've,mustn't,my,neither,no,nor,not,o'clock,of,off," .
            "often,on,only,or,other,our,own,rather,said,say,says,shan't,she,she'd,she'll,she's,should,should've," .
            "shouldn't,since,so,some,than,that,that'll,that's,the,their,them,then,there,there's,these,they,they'd," .
            "they'll,they're,they've,this,tis,to,too,twas,us, up, wants,was,wasn't,we,we'd,we'll,we're,were,weren't,what," .
            "what'd,what's,when,when,when'd,when'll,when's,where,where'd,where'll,where's,which,while,who,who'd," .
            "who'll,who's,whom,why,why'd,why'll,why's,will,with,won't,would,would've,wouldn't,yet,you,you'd,you'll," .
            "you're,you've,your";
        
        $commonWords = strtolower($commonWords);
        $commonWords = explode(",", $commonWords);
        $commonWords = array_merge ( $commonWords, $stopWords);
        foreach($commonWords as $commonWord)
        {
            $text = $this->str_replace_word($commonWord, "", $text);  
        }

        /* remove punctuation and newlines */
        /*
         * Changed to handle international characters
         */
        if ($this->m_bUTF8)
            $text = preg_replace('/[^\p{L}0-9\s]|\n|\r/u',' ',$text);
        else
            $text = preg_replace('/[^a-zA-Z0-9\s]|\n|\r/',' ',$text);
            
        /* remove extra spaces created */
        $text = preg_replace('/ +/',' ',$text);
      
        $text = trim($text);
        $words = explode(" ", $text);
        foreach ($words as $value) 
        {
            $temp = trim($value);
            if (is_numeric($temp))
                continue;
            $keywords[] = trim($temp);
        }
    
        return $keywords;
    }
  
    function addTagsFromText($SeedText)
    {
        $words = $this->keywords_extract($SeedText);
		foreach ($words as $key => $value)
		{
			$this->addTag($value);
		}
    }
	
	function addTag($tag, $useCount = 1)
	{
		$tag = strtolower($tag);
		if (array_key_exists($tag, $this->m_arTags))
			$this->m_arTags[$tag] += $useCount;
		else
			$this->m_arTags[$tag] = $useCount;
	}
	 
	function gradeFrequency($frequency)
	{
	    $grade = 0;
		if ($frequency >= 90)
			$grade = 13;
		else if ($frequency >= 70)
			$grade = 12;
		else if ($frequency >= 60)
			$grade = 10;
		else if ($frequency >= 50)
			$grade = 8;
		else if ($frequency >= 40)
			$grade = 7;
		else if ($frequency >= 30)
			$grade = 6;
		else if ($frequency >= 20)
			$grade = 3;
		else if ($frequency >= 10)
			$grade = 2;
		else if ($frequency >= 5)
			$grade = 1;
		 
		return $grade;
	}
	 
	function emitCloud($bHTML = true)
	{
	    arsort($this->m_arTags);
	    $arTopTags = array_slice($this->m_arTags, 0, $this->m_displayedElementsCount);
	    
	    /* randomize the order of elements */
		uasort($arTopTags, 'randomSort');
		
		$this->maxCount = max($this->m_arTags);
		if (is_array($this->m_arTags))
		{
			if ($bHTML) 
			    $result = '<div id="id_tag_cloud" style="' . (isset($this->m_width) ? ("width:". $this->m_width. ";") : "") .
			               'line-height:normal"><div style="border-style:solid;border-width:1px;' .
			              (isset($this->m_backgroundImage) ? ("background:url('". $this->m_backgroundImage ."');") : "") .
			              'border-color:#888;margin-top:20px;margin-bottom:10px;padding:5px 5px 20px 5px;background-color:'.$this->m_backgroundColor.';">';
            else			    
                $result = array();
			foreach ($arTopTags as $tag => $useCount)
			{
				$grade = $this->gradeFrequency(($useCount * 100) / $this->maxCount);
				if ($bHTML)
				{
					$result .= ("<a href=\"". $this->m_searchURL.urlencode($tag)."\" title=\"More info on " .
					    $tag."\" style=\"color:".$this->m_arColors[$grade].";\">" .
					    "<span style=\"color:".$this->m_arColors[$grade]."; letter-spacing:3px; ".
					    "padding:4px; font-family:Tahoma; font-weight:900; font-size:" . 
					    (0.6 + 0.1 * $grade) . "em\">".$tag."</span></a> ");
				}
				else
				    $result[$tag] = $grade;
			}
			if ($bHTML)
                $result .= ('</div><div style="position:relative;top:-25px">' .
                           '<div style="float:right;padding-right:5px;height:15px;font-size:10px">' .
                           '<a style="color:#777" target="_blank" href="http://www.softwaremastercenter.com">free shareware downloads</a>' .
                           '</div></div></div><br />');

			return $result;
		}
	}
}
?>
