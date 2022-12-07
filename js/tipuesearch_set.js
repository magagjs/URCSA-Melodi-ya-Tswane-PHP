
/*
Tipue Search 6.1
Copyright (c) 2017 Tipue
Tipue Search is released under the MIT License
http://www.tipue.com/search
*/

/* Modified for Myt Website: 2018/05/29 */

/*
Stop words
Stop words list from http://www.ranks.nl/stopwords
*/

var tipuesearch_stop_words = ["a", "about", "above", "after", "again", "against", "all", "am", "an", "and", "any", "are", "aren't", "as", "at", "be", "because", "been", "before", "being", "below", "between", "both", "but", "by", "can't", "cannot", "could", "couldn't", "did", "didn't", "do", "does", "doesn't", "doing", "don't", "down", "during", "each", "few", "for", "from", "further", "had", "hadn't", "has", "hasn't", "have", "haven't", "having", "he", "he'd", "he'll", "he's", "her", "here", "here's", "hers", "herself", "him", "himself", "his", "how", "how's", "i", "i'd", "i'll", "i'm", "i've", "if", "in", "into", "is", "isn't", "it", "it's", "its", "itself", "let's", "me", "more", "most", "mustn't", "my", "myself", "no", "nor", "not", "of", "off", "on", "once", "only", "or", "other", "ought", "our", "ours", "ourselves", "out", "over", "own", "same", "shan't", "she", "she'd", "she'll", "she's", "should", "shouldn't", "so", "some", "such", "than", "that", "that's", "the", "their", "theirs", "them", "themselves", "then", "there", "there's", "these", "they", "they'd", "they'll", "they're", "they've", "this", "those", "through", "to", "too", "under", "until", "up", "very", "was", "wasn't", "we", "we'd", "we'll", "we're", "we've", "were", "weren't", "what", "what's", "when", "when's", "where", "where's", "which", "while", "who", "who's", "whom", "why", "why's", "with", "won't", "would", "wouldn't", "you", "you'd", "you'll", "you're", "you've", "your", "yours", "yourself", "yourselves"];


// Word replace

var tipuesearch_replace = {'words': [
     {'word': 'tip', 'replace_with': 'tipue'},
     {'word': 'javscript', 'replace_with': 'javascript'},
     {'word': 'jqeury', 'replace_with': 'jquery'}
]};


// Weighting

var tipuesearch_weight = {'weight': [
     {'url': 'http://www.tipue.com', 'score': 20},
     {'url': 'http://www.tipue.com/search', 'score': 30},
     {'url': 'http://www.tipue.com/is', 'score': 10}
]};


// Illogical stemming

var tipuesearch_stem = {'words': [
     {'word': 'e-mail', 'stem': 'email'},
     {'word': 'javascript', 'stem': 'jquery'},
     {'word': 'javascript', 'stem': 'js'}
]};


// Related searches

var tipuesearch_related = {'searches': [
     {'search': 'tipue', 'related': 'Tipue Search'},
     {'search': 'tipue', 'before': 'Tipue Search', 'related': 'Getting Started'},
     {'search': 'tipue', 'before': 'Tipue', 'related': 'jQuery'},
     {'search': 'tipue', 'before': 'Tipue', 'related': 'Blog'}
]};


// Internal strings

var tipuesearch_string_1 = 'No title';
var tipuesearch_string_2 = 'Showing results for';
var tipuesearch_string_3 = 'Search instead for';
var tipuesearch_string_4 = '1 result';
var tipuesearch_string_5 = 'results';
var tipuesearch_string_6 = 'Back';
var tipuesearch_string_7 = 'More';
var tipuesearch_string_8 = 'Nothing found.';
var tipuesearch_string_9 = 'Common words are largely ignored.';
var tipuesearch_string_10 = 'Search too short';
var tipuesearch_string_11 = 'Should be one character or more.';
var tipuesearch_string_12 = 'Should be';
var tipuesearch_string_13 = 'characters or more.';
var tipuesearch_string_14 = 'seconds';
var tipuesearch_string_15 = 'Searches related to';


// Internals


// Timer for showTime

var startTimer = new Date().getTime();

// MyT Changes:2018/05/29: List of pages to search: Localhost
/*var tipuesearch_pages = ["http://localhost/","http://localhost/aboutus.php",
                         "http://localhost/academiccom.php","http://localhost/announcements.php",
                         "http://localhost/choir.php","http://localhost/communicationscom.php",
                         "http://localhost/congregation.php","http://localhost/event.php",
                         "http://localhost/financecom.php","http://localhost/footer.php",
                         "http://localhost/gallery.php","http://localhost/healthcom.php",
                         "http://localhost/ministries.php","http://localhost/mytcmm.php",
                         "http://localhost/mytcwl.php","http://localhost/mytcwm.php",
                         "http://localhost/mytcym.php","http://localhost/mytyouth.php",
                         "http://localhost/outreachcom.php","http://localhost/privacy.php",
                         "http://localhost/wards.php","http://localhost/scripture.php"];*/

//MyT Changes:2018/05/29: List of pages to search: Live Website: Unsecure
var tipuesearch_pages = ["http://mytchurch.co.za/","http://mytchurch.co.za/aboutus.php",
                         "http://mytchurch.co.za/academiccom.php","http://mytchurch.co.za/announcements.php",
                         "http://mytchurch.co.za/choir.php","http://mytchurch.co.za/communicationscom.php",
                         "http://mytchurch.co.za/congregation.php","http://mytchurch.co.za/event.php",
                         "http://mytchurch.co.za/financecom.php","http://mytchurch.co.za/footer.php",
                         "http://mytchurch.co.za/gallery.php","http://mytchurch.co.za/healthcom.php",
                         "http://mytchurch.co.za/ministries.php","http://mytchurch.co.za/mytcmm.php",
                         "http://mytchurch.co.za/mytcwl.php","http://mytchurch.co.za/mytcwm.php",
                         "http://mytchurch.co.za/mytcym.php","http://mytchurch.co.za/mytyouth.php",
                         "http://mytchurch.co.za/outreachcom.php","http://mytchurch.co.za/privacy.php",
                         "http://mytchurch.co.za/wards.php","http://mytchurch.co.za/scripture.php"];

//MyT Changes:2018/05/29: List of pages to search: Live Website: Secure
/*var tipuesearch_pages = ["https://mytchurch.co.za/","https://mytchurch.co.za/aboutus.php",
                         "https://mytchurch.co.za/academiccom.php","https://mytchurch.co.za/announcements.php",
                         "https://mytchurch.co.za/choir.php","https://mytchurch.co.za/communicationscom.php",
                         "https://mytchurch.co.za/congregation.php","https://mytchurch.co.za/event.php",
                         "https://mytchurch.co.za/financecom.php","https://mytchurch.co.za/footer.php",
                         "https://mytchurch.co.za/gallery.php","https://mytchurch.co.za/healthcom.php",
                         "https://mytchurch.co.za/ministries.php","https://mytchurch.co.za/mytcmm.php",
                         "https://mytchurch.co.za/mytcwl.php","https://mytchurch.co.za/mytcwm.php",
                         "https://mytchurch.co.za/mytcym.php","https://mytchurch.co.za/mytyouth.php",
                         "https://mytchurch.co.za/outreachcom.php","https://mytchurch.co.za/privacy.php",
                         "https://mytchurch.co.za/wards.php","https://mytchurch.co.za/scripture.php"];*/

//MyT Changes:2018/05/29: List of pages to search: Github
/*var tipuesearch_pages = ["https://magags.github.io/myt/","https://magags.github.io/myt/aboutus.php",
                         "https://magags.github.io/myt/academiccom.php", "https://magags.github.io/myt/announcements.php",
                         "https://magags.github.io/myt/choir.php","https://magags.github.io/myt/communicationscom.php",
                         "https://magags.github.io/myt/congregation.php","https://magags.github.io/myt/event.php",
                         "https://magags.github.io/myt/financecom.php","https://magags.github.io/myt/footer.php",
                         "https://magags.github.io/myt/gallery.php","https://magags.github.io/myt/healthcom.php",
                         "https://magags.github.io/myt/ministries.php","https://magags.github.io/myt/mytcmm.php",
                         "https://magags.github.io/myt/mytcwl.php","https://magags.github.io/myt/mytcwm.php",
                         "https://magags.github.io/myt/mytcym.php","https://magags.github.io/myt/mytyouth.php",
                         "https://magags.github.io/myt/outreachcom.php","https://magags.github.io/myt/privacy.php",
                         "https://magags.github.io/myt/wards.php","https://magags.github.io/myt/scripture.php"];*/

