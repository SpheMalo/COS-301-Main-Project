<?php
/** Croatian (hrvatski)
 *
 * To improve a translation please visit https://translatewiki.net
 *
 * @ingroup Language
 * @file
 *
 */

$namespaceNames = array(
	NS_MEDIA            => 'Mediji',
	NS_SPECIAL          => 'Posebno',
	NS_TALK             => 'Razgovor',
	NS_USER             => 'Suradnik',
	NS_USER_TALK        => 'Razgovor_sa_suradnikom',
	NS_PROJECT_TALK     => 'Razgovor_$1',
	NS_FILE             => 'Datoteka',
	NS_FILE_TALK        => 'Razgovor_o_datoteci',
	NS_MEDIAWIKI        => 'MediaWiki',
	NS_MEDIAWIKI_TALK   => 'MediaWiki_razgovor',
	NS_TEMPLATE         => 'Predložak',
	NS_TEMPLATE_TALK    => 'Razgovor_o_predlošku',
	NS_HELP             => 'Pomoć',
	NS_HELP_TALK        => 'Razgovor_o_pomoći',
	NS_CATEGORY         => 'Kategorija',
	NS_CATEGORY_TALK    => 'Razgovor_o_kategoriji',
);

$namespaceAliases = array(
	'Slika' => NS_FILE,
	'Razgovor_o_slici' => NS_FILE_TALK,
);

$namespaceGenderAliases = array(
	NS_USER => array( 'male' => 'Suradnik', 'female' => 'Suradnica' ),
	NS_USER_TALK => array( 'male' => 'Razgovor_sa_suradnikom', 'female' => 'Razgovor_sa_suradnicom' ),
);

$specialPageAliases = array(
	'Activeusers'               => array( 'Aktivni_suradnici' ),
	'Allmessages'               => array( 'Sve_poruke' ),
	'Allpages'                  => array( 'Sve_stranice' ),
	'Ancientpages'              => array( 'Stare_stranice' ),
	'Blankpage'                 => array( 'Prazna_stranica' ),
	'Block'                     => array( 'Blokiraj' ),
	'Booksources'               => array( 'Traži_ISBN' ),
	'BrokenRedirects'           => array( 'Kriva_preusmjeravanja' ),
	'Categories'                => array( 'Kategorije' ),
	'ChangePassword'            => array( 'Izmijeni_lozinku' ),
	'Confirmemail'              => array( 'E-mail_potvrda' ),
	'Contributions'             => array( 'Doprinosi' ),
	'CreateAccount'             => array( 'Stvori_račun' ),
	'Deadendpages'              => array( 'Slijepe_ulice' ),
	'DeletedContributions'      => array( 'Obrisani_doprinosi' ),
	'DoubleRedirects'           => array( 'Dvostruka_preusmjeravanja' ),
	'Emailuser'                 => array( 'Elektronička_pošta', 'E-mail' ),
	'Export'                    => array( 'Izvezi' ),
	'Fewestrevisions'           => array( 'Najmanje_uređivane_stranice' ),
	'FileDuplicateSearch'       => array( 'Traži_kopije_datoteka' ),
	'Filepath'                  => array( 'Putanja_datoteke' ),
	'Import'                    => array( 'Uvezi' ),
	'Invalidateemail'           => array( 'Nevaljana_elektronička_pošta' ),
	'BlockList'                 => array( 'Blokirane_adrese' ),
	'LinkSearch'                => array( 'Traži_poveznice', 'Traži_linkove' ),
	'Listadmins'                => array( 'Administratori', 'Admini' ),
	'Listbots'                  => array( 'Botovi' ),
	'Listfiles'                 => array( 'Datoteke', 'Slike' ),
	'Listgrouprights'           => array( 'Suradničke_skupine' ),
	'Listredirects'             => array( 'Preusmjeravanja' ),
	'Listusers'                 => array( 'Suradnici', 'Popis_suradnika' ),
	'Lockdb'                    => array( 'Zaključaj_bazu' ),
	'Log'                       => array( 'Evidencije' ),
	'Lonelypages'               => array( 'Siročad' ),
	'Longpages'                 => array( 'Duge_stranice' ),
	'MergeHistory'              => array( 'Spoji_povijest' ),
	'MIMEsearch'                => array( 'MIME_tražilica' ),
	'Mostcategories'            => array( 'Najviše_kategorija' ),
	'Mostimages'                => array( 'Najviše_povezane_datoteke', 'Najviše_povezane_slike' ),
	'Mostlinked'                => array( 'Najviše_povezane_stranice' ),
	'Mostlinkedcategories'      => array( 'Najviše_povezane_kategorije' ),
	'Mostlinkedtemplates'       => array( 'Najviše_povezani_predlošci' ),
	'Mostrevisions'             => array( 'Najviše_uređivane_stranice' ),
	'Movepage'                  => array( 'Premjesti_stranicu' ),
	'Mycontributions'           => array( 'Moji_doprinosi' ),
	'Mypage'                    => array( 'Moja_stranica' ),
	'Mytalk'                    => array( 'Moj_razgovor' ),
	'Myuploads'                 => array( 'Moje_datoteke' ),
	'Newimages'                 => array( 'Nove_datoteke', 'Nove_slike' ),
	'Newpages'                  => array( 'Nove_stranice' ),
	'Popularpages'              => array( 'Popularne_stranice' ),
	'Preferences'               => array( 'Postavke' ),
	'Prefixindex'               => array( 'Prefiks_indeks', 'Stranice_po_prefiksu' ),
	'Protectedpages'            => array( 'Zaštićene_stranice' ),
	'Protectedtitles'           => array( 'Zaštićeni_naslovi' ),
	'Randompage'                => array( 'Slučajna_stranica' ),
	'Randomredirect'            => array( 'Slučajno_preusmjeravanje' ),
	'Recentchanges'             => array( 'Nedavne_promjene' ),
	'Recentchangeslinked'       => array( 'Povezane_promjene' ),
	'Revisiondelete'            => array( 'Brisanje_izmjene' ),
	'Search'                    => array( 'Traži' ),
	'Shortpages'                => array( 'Kratke_stranice' ),
	'Specialpages'              => array( 'Posebne_stranice' ),
	'Statistics'                => array( 'Statistika' ),
	'Tags'                      => array( 'Oznake' ),
	'Unblock'                   => array( 'Odblokiraj' ),
	'Uncategorizedcategories'   => array( 'Nekategorizirane_kategorije' ),
	'Uncategorizedimages'       => array( 'Nekategorizirane_slike' ),
	'Uncategorizedpages'        => array( 'Nekategorizirane_stranice' ),
	'Uncategorizedtemplates'    => array( 'Nekategorizirani_predlošci' ),
	'Undelete'                  => array( 'Vrati' ),
	'Unlockdb'                  => array( 'Otključaj_bazu' ),
	'Unusedcategories'          => array( 'Nekorištene_kategorije' ),
	'Unusedimages'              => array( 'Nekorištene_datoteke', 'Nekorištene_slike' ),
	'Unusedtemplates'           => array( 'Nekorišteni_predlošci' ),
	'Unwatchedpages'            => array( 'Negledane_stranice' ),
	'Upload'                    => array( 'Postavi_datoteku' ),
	'Userlogin'                 => array( 'Prijava' ),
	'Userlogout'                => array( 'Odjava' ),
	'Userrights'                => array( 'Suradnička_prava' ),
	'Version'                   => array( 'Verzija', 'Inačica' ),
	'Wantedcategories'          => array( 'Tražene_kategorije' ),
	'Wantedfiles'               => array( 'Tražene_datoteke' ),
	'Wantedpages'               => array( 'Tražene_stranice' ),
	'Wantedtemplates'           => array( 'Traženi_predlošci' ),
	'Watchlist'                 => array( 'Praćene_stranice' ),
	'Whatlinkshere'             => array( 'Što_vodi_ovamo' ),
	'Withoutinterwiki'          => array( 'Bez_međuwikipoveznica', 'Bez_interwikija' ),
);

$magicWords = array(
	'redirect'                  => array( '0', '#Preusmjeri', '#PREUSMJERI', '#REDIRECT' ),
	'notoc'                     => array( '0', '__BEZSADRŽAJA__', '__NOTOC__' ),
	'nogallery'                 => array( '0', '__BEZGALERIJE__', '__NOGALLERY__' ),
	'forcetoc'                  => array( '0', '__UKLJUČISADRŽAJ__', '__FORCETOC__' ),
	'toc'                       => array( '0', '__SADRŽAJ__', '__TOC__' ),
	'noeditsection'             => array( '0', '__BEZUREĐIVANJAODLOMAKA__', '__NOEDITSECTION__' ),
	'currentmonth'              => array( '1', 'TRENUTAČNIMJESEC', 'CURRENTMONTH', 'CURRENTMONTH2' ),
	'currentmonth1'             => array( '1', 'TRENUTAČNIMJESEC1', 'CURRENTMONTH1' ),
	'currentmonthname'          => array( '1', 'TRENUTAČNIMJESECIME', 'CURRENTMONTHNAME' ),
	'currentmonthnamegen'       => array( '1', 'TRENUTAČNIMJESECIMEGEN', 'CURRENTMONTHNAMEGEN' ),
	'currentmonthabbrev'        => array( '1', 'TRENUTAČNIMJESECKRAT', 'CURRENTMONTHABBREV' ),
	'currentday'                => array( '1', 'TRENUTAČNIDAN', 'CURRENTDAY' ),
	'currentday2'               => array( '1', 'TRENUTAČNIDAN2', 'CURRENTDAY2' ),
	'currentdayname'            => array( '1', 'TRENUTAČNIDANIME', 'CURRENTDAYNAME' ),
	'currentyear'               => array( '1', 'TRENUTAČNAGODINA', 'CURRENTYEAR' ),
	'currenttime'               => array( '1', 'TRENUTAČNOVRIJEME', 'CURRENTTIME' ),
	'currenthour'               => array( '1', 'TRENUTAČNISAT', 'CURRENTHOUR' ),
	'localmonth'                => array( '1', 'MJESNIMJESEC', 'LOCALMONTH', 'LOCALMONTH2' ),
	'localmonth1'               => array( '1', 'MJESNIMJESEC1', 'LOCALMONTH1' ),
	'localmonthname'            => array( '1', 'MJESNIMJESECIME', 'LOCALMONTHNAME' ),
	'localmonthnamegen'         => array( '1', 'MJESNIMJESECIMEGEN', 'LOCALMONTHNAMEGEN' ),
	'localmonthabbrev'          => array( '1', 'MJESNIMJESECKRAT', 'LOCALMONTHABBREV' ),
	'localday'                  => array( '1', 'MJESNIDAN', 'LOCALDAY' ),
	'localday2'                 => array( '1', 'MJESNIDAN2', 'LOCALDAY2' ),
	'localdayname'              => array( '1', 'MJESNIDANIME', 'LOCALDAYNAME' ),
	'localyear'                 => array( '1', 'MJESNAGODINA', 'LOCALYEAR' ),
	'localtime'                 => array( '1', 'MJESNOVRIJEME', 'LOCALTIME' ),
	'localhour'                 => array( '1', 'MJESNISAT', 'LOCALHOUR' ),
	'numberofpages'             => array( '1', 'BROJSTRANICA', 'NUMBEROFPAGES' ),
	'numberofarticles'          => array( '1', 'BROJČLANAKA', 'NUMBEROFARTICLES' ),
	'numberoffiles'             => array( '1', 'BROJDATOTEKA', 'NUMBEROFFILES' ),
	'numberofusers'             => array( '1', 'BROJSURADNIKA', 'NUMBEROFUSERS' ),
	'numberofactiveusers'       => array( '1', 'BROJAKTIVNIHSURADNIKA', 'NUMBEROFACTIVEUSERS' ),
	'numberofedits'             => array( '1', 'BROJUREĐIVANJA', 'NUMBEROFEDITS' ),
	'pagename'                  => array( '1', 'IMESTRANICE', 'PAGENAME' ),
	'pagenamee'                 => array( '1', 'IMESTRANICEE', 'PAGENAMEE' ),
	'namespace'                 => array( '1', 'IMENSKIPROSTOR', 'NAMESPACE' ),
	'namespacee'                => array( '1', 'IMENSKIPROSTORE', 'NAMESPACEE' ),
	'talkspace'                 => array( '1', 'RAZGOVOR', 'TALKSPACE' ),
	'talkspacee'                => array( '1', 'RAZGOVORE', 'TALKSPACEE' ),
	'subjectspace'              => array( '1', 'PROSTORSTRANICE', 'IMPSTRANICE', 'SUBJECTSPACE', 'ARTICLESPACE' ),
	'subjectspacee'             => array( '1', 'PROSTORSTRANICEE', 'IMPSTRANICEE', 'SUBJECTSPACEE', 'ARTICLESPACEE' ),
	'fullpagename'              => array( '1', 'PUNOIMESTRANICE', 'FULLPAGENAME' ),
	'fullpagenamee'             => array( '1', 'PUNOIMESTRANICEE', 'FULLPAGENAMEE' ),
	'subpagename'               => array( '1', 'IMEPODSTRANICE', 'SUBPAGENAME' ),
	'subpagenamee'              => array( '1', 'IMEPODSTRANICEE', 'SUBPAGENAMEE' ),
	'basepagename'              => array( '1', 'IMEOSNOVNESTRANICE', 'BASEPAGENAME' ),
	'basepagenamee'             => array( '1', 'IMEOSNOVNESTRANICEE', 'BASEPAGENAMEE' ),
	'talkpagename'              => array( '1', 'IMERAZGOVORASTRANICE', 'TALKPAGENAME' ),
	'talkpagenamee'             => array( '1', 'IMERAZGOVORASTRANICEE', 'TALKPAGENAMEE' ),
	'subjectpagename'           => array( '1', 'IMEGLAVNESTRANICE', 'SUBJECTPAGENAME', 'ARTICLEPAGENAME' ),
	'subjectpagenamee'          => array( '1', 'IMEGLAVNESTRANICEE', 'SUBJECTPAGENAMEE', 'ARTICLEPAGENAMEE' ),
	'subst'                     => array( '0', 'ZAMJENA:', 'SUBST:' ),
	'img_thumbnail'             => array( '1', 'minijatura', 'mini', 'thumbnail', 'thumb' ),
	'img_manualthumb'           => array( '1', 'minijatura=$1', 'thumbnail=$1', 'thumb=$1' ),
	'img_right'                 => array( '1', 'desno', 'right' ),
	'img_left'                  => array( '1', 'lijevo', 'left' ),
	'img_none'                  => array( '1', 'ništa', 'none' ),
	'img_center'                => array( '1', 'središte', 'center', 'centre' ),
	'img_framed'                => array( '1', 'okvir', 'framed', 'enframed', 'frame' ),
	'img_frameless'             => array( '1', 'bezokvira', 'frameless' ),
	'img_lang'                  => array( '1', 'jezik=$1', 'lang=$1' ),
	'img_page'                  => array( '1', 'stranica=$1', 'stranica $1', 'page=$1', 'page $1' ),
	'img_upright'               => array( '1', 'uspravno=$1', 'uspravno $1', 'upright', 'upright=$1', 'upright $1' ),
	'img_border'                => array( '1', 'obrub', 'border' ),
	'img_baseline'              => array( '1', 'osnovnacrta', 'baseline' ),
	'img_sub'                   => array( '1', 'potpis', 'ind', 'sub' ),
	'img_super'                 => array( '1', 'natpis', 'eks', 'super', 'sup' ),
	'img_top'                   => array( '1', 'vrh', 'top' ),
	'img_text_top'              => array( '1', 'tekst-vrh', 'text-top' ),
	'img_middle'                => array( '1', 'pola', 'middle' ),
	'img_bottom'                => array( '1', 'dno', 'bottom' ),
	'img_text_bottom'           => array( '1', 'tekst-dno', 'text-bottom' ),
	'img_link'                  => array( '1', 'poveznica=$1', 'link=$1' ),
	'sitename'                  => array( '1', 'IMEPROJEKTA', 'SITENAME' ),
	'ns'                        => array( '0', 'IMP:', 'NS:' ),
	'localurl'                  => array( '0', 'MJESNIURL:', 'LOCALURL:' ),
	'localurle'                 => array( '0', 'MJESNIURLE:', 'LOCALURLE:' ),
	'servername'                => array( '0', 'IMESERVERA', 'SERVERNAME' ),
	'scriptpath'                => array( '0', 'PUTANJASKRIPTE', 'SCRIPTPATH' ),
	'grammar'                   => array( '0', 'GRAMATIKA:', 'GRAMMAR:' ),
	'notitleconvert'            => array( '0', '__BEZPRETVARANJANASLOVA__', '__BPN__', '__NOTITLECONVERT__', '__NOTC__' ),
	'nocontentconvert'          => array( '0', '__BEZPRETVARANJASADRŽAJA__', '__BPS__', '__NOCONTENTCONVERT__', '__NOCC__' ),
	'currentweek'               => array( '1', 'TRENUTAČNITJEDAN', 'CURRENTWEEK' ),
	'currentdow'                => array( '1', 'TRENUTAČNIDANTJEDNA', 'CURRENTDOW' ),
	'localweek'                 => array( '1', 'MJESNITJEDAN', 'LOCALWEEK' ),
	'localdow'                  => array( '1', 'MJESNIDANTJEDNA', 'LOCALDOW' ),
	'revisionid'                => array( '1', 'IDIZMJENE', 'REVISIONID' ),
	'revisionday'               => array( '1', 'DANIZMJENE', 'REVISIONDAY' ),
	'revisionday2'              => array( '1', 'DANIZMJENE2', 'REVISIONDAY2' ),
	'revisionmonth'             => array( '1', 'MJESECIZMJENE', 'REVISIONMONTH' ),
	'revisionyear'              => array( '1', 'GODINAIZMJENE', 'REVISIONYEAR' ),
	'revisiontimestamp'         => array( '1', 'VREMENSKAOZNAKAIZMJENE', 'REVISIONTIMESTAMP' ),
	'plural'                    => array( '0', 'MNOŽINA:', 'PLURAL:' ),
	'fullurl'                   => array( '0', 'PUNIURL:', 'FULLURL:' ),
	'fullurle'                  => array( '0', 'PUNIURLE:', 'FULLURLE:' ),
	'lcfirst'                   => array( '0', 'MSPRVO:', 'LCFIRST:' ),
	'ucfirst'                   => array( '0', 'VSPRVO:', 'UCFIRST:' ),
	'lc'                        => array( '0', 'MS:', 'LC:' ),
	'uc'                        => array( '0', 'VS:', 'UC:' ),
	'raw'                       => array( '0', 'NEOBRAĐENO:', 'RAW:' ),
	'displaytitle'              => array( '1', 'POKAŽINASLOV', 'DISPLAYTITLE' ),
	'rawsuffix'                 => array( '1', 'NEO', 'R' ),
	'newsectionlink'            => array( '1', '__NOVIODLOMAKPOVEZNICA__', '__NEWSECTIONLINK__' ),
	'currentversion'            => array( '1', 'TRENUTAČNAIZMJENA', 'CURRENTVERSION' ),
	'urlencode'                 => array( '0', 'URLKODIRANJE:', 'URLENCODE:' ),
	'anchorencode'              => array( '0', 'SIDROKODIRANJE', 'ANCHORENCODE' ),
	'currenttimestamp'          => array( '1', 'TRENUTAČNAOZNAKAVREMENA', 'CURRENTTIMESTAMP' ),
	'localtimestamp'            => array( '1', 'MJESNAOZNAKAVREMENA', 'LOCALTIMESTAMP' ),
	'language'                  => array( '0', '#JEZIK:', '#LANGUAGE:' ),
	'contentlanguage'           => array( '1', 'JEZIKPROJEKTA', 'CONTENTLANGUAGE', 'CONTENTLANG' ),
	'pagesinnamespace'          => array( '1', 'STRANICEPOPROSTORU:', 'STRANICEUIMP', 'PAGESINNAMESPACE:', 'PAGESINNS:' ),
	'numberofadmins'            => array( '1', 'BROJADMINA', 'NUMBEROFADMINS' ),
	'formatnum'                 => array( '0', 'OBLIKBROJA', 'FORMATNUM' ),
	'padleft'                   => array( '0', 'POSTAVALIJEVO', 'PADLEFT' ),
	'padright'                  => array( '0', 'POSTAVADESNO', 'PADRIGHT' ),
	'special'                   => array( '0', 'posebno', 'special' ),
	'defaultsort'               => array( '1', 'GLAVNIRASPORED:', 'DEFAULTSORT:', 'DEFAULTSORTKEY:', 'DEFAULTCATEGORYSORT:' ),
	'filepath'                  => array( '0', 'PUTANJADATOTEKE:', 'FILEPATH:' ),
	'tag'                       => array( '0', 'oznaka', 'tag' ),
	'hiddencat'                 => array( '1', '__SKRIVENAKAT__', '__HIDDENCAT__' ),
	'pagesincategory'           => array( '1', 'STRANICEPOKATEGORIJI', 'STRANICEUKAT', 'PAGESINCATEGORY', 'PAGESINCAT' ),
	'pagesize'                  => array( '1', 'VELIČINASTRANICE', 'PAGESIZE' ),
	'index'                     => array( '1', '__KAZALO__', '__INDEX__' ),
	'noindex'                   => array( '1', '__BEZKAZALA__', '__NOINDEX__' ),
	'staticredirect'            => array( '1', '__NEPOMIČNOPREUSMJERAVANJE__', '__STATICREDIRECT__' ),
);

$datePreferences = array(
	'default',
	'dmy hr',
	'mdy',
	'ymd',
	'ISO 8601',
);

$defaultDateFormat = 'dmy hr';

$dateFormats = array(
	'dmy hr time' => 'H:i',
	'dmy hr date' => 'j. F Y.',
	'dmy hr both' => 'H:i, j. F Y.',

	'mdy time' => 'H:i',
	'mdy date' => 'F j, Y',
	'mdy both' => 'H:i, F j, Y',

	'ymd time' => 'H:i',
	'ymd date' => 'Y F j',
	'ymd both' => 'H:i, Y F j',

	'ISO 8601 time' => 'xnH:xni:xns',
	'ISO 8601 date' => 'xnY-xnm-xnd',
	'ISO 8601 both' => 'xnY-xnm-xnd"T"xnH:xni:xns',
);

$separatorTransformTable = array( ',' => '.', '.' => ',' );

$fallback8bitEncoding = 'iso-8859-2';

$linkTrail = '/^([čšžćđßa-z]+)(.*)$/sDu';

