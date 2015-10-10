<?php
/** Korean (한국어)
 *
 * To improve a translation please visit https://translatewiki.net
 *
 * @ingroup Language
 * @file
 *
 * @author Albamhandae
 * @author Altostratus
 * @author Chanhee
 * @author ChongDae
 * @author Chulki Lee
 * @author Clockoon
 * @author Cwt96
 * @author Devunt
 * @author Ficell
 * @author Freebiekr
 * @author Gapo
 * @author Gjue
 * @author Ha98574
 * @author Hoo
 * @author Hym411
 * @author IRTC1015
 * @author ITurtle
 * @author Idh0854
 * @author Jmkim dot com
 * @author Jskang
 * @author Kaganer
 * @author Klutzy
 * @author Kwj2772
 * @author LFM
 * @author Leehoy
 * @author Mintz0223
 * @author Pi.C.Noizecehx
 * @author Priviet
 * @author PuzzletChung
 * @author TheAlpha for knowledge
 * @author ToePeu
 * @author Yjs5497
 * @author Yknok29
 * @author לערי ריינהארט
 * @author 관인생략
 * @author 아라
 */

$namespaceNames = array(
	NS_MEDIA            => '미디어',
	NS_SPECIAL          => '특수',
	NS_TALK             => '토론',
	NS_USER             => '사용자',
	NS_USER_TALK        => '사용자토론',
	NS_PROJECT_TALK     => '$1토론',
	NS_FILE             => '파일',
	NS_FILE_TALK        => '파일토론',
	NS_MEDIAWIKI        => '미디어위키',
	NS_MEDIAWIKI_TALK   => '미디어위키토론',
	NS_TEMPLATE         => '틀',
	NS_TEMPLATE_TALK    => '틀토론',
	NS_HELP             => '도움말',
	NS_HELP_TALK        => '도움말토론',
	NS_CATEGORY         => '분류',
	NS_CATEGORY_TALK    => '분류토론',
);

$namespaceAliases = array(
	'특' => NS_SPECIAL,
	'특수기능' => NS_SPECIAL,
	'MediaWiki토론' => NS_MEDIAWIKI_TALK,
	'그림' => NS_FILE,
	'그림토론' => NS_FILE_TALK,
);

$specialPageAliases = array(
	'Activeusers'               => array( '활동적인사용자' ),
	'Allmessages'               => array( '모든메시지' ),
	'AllMyUploads'              => array( '모든내올린파일', '모든내파일' ),
	'Allpages'                  => array( '모든문서' ),
	'ApiHelp'                   => array( 'Api도움말' ),
	'Ancientpages'              => array( '오래된문서' ),
	'Badtitle'                  => array( '잘못된제목', '인식불가제목', '잘못된이름', '인식불가이름' ),
	'Blankpage'                 => array( '빈문서' ),
	'Block'                     => array( '차단', 'IP차단', '사용자차단' ),
	'Booksources'               => array( '책찾기' ),
	'BrokenRedirects'           => array( '끊긴넘겨주기' ),
	'Categories'                => array( '분류' ),
	'ChangeEmail'               => array( '이메일바꾸기', '이메일변경' ),
	'ChangePassword'            => array( '비밀번호바꾸기', '비밀번호변경' ),
	'ComparePages'              => array( '문서비교' ),
	'Confirmemail'              => array( '이메일확인', '이메일인증' ),
	'Contributions'             => array( '기여', '기여목록' ),
	'CreateAccount'             => array( '계정만들기', '가입' ),
	'Deadendpages'              => array( '막다른문서' ),
	'DeletedContributions'      => array( '삭제된기여' ),
	'Diff'                      => array( '차이' ),
	'DoubleRedirects'           => array( '이중넘겨주기' ),
	'EditWatchlist'             => array( '주시문서목록편집' ),
	'Emailuser'                 => array( '이메일보내기', '이메일' ),
	'ExpandTemplates'           => array( '틀전개' ),
	'Export'                    => array( '내보내기' ),
	'Fewestrevisions'           => array( '역사짧은문서' ),
	'FileDuplicateSearch'       => array( '중복파일검색', '중복파일찾기' ),
	'Filepath'                  => array( '파일경로', '그림경로' ),
	'Import'                    => array( '가져오기' ),
	'Invalidateemail'           => array( '이메일인증취소', '이메일인증해제' ),
	'JavaScriptTest'            => array( '자바스크립트시험', '자바스크립트테스트' ),
	'BlockList'                 => array( '차단목록', 'IP차단목록', '차단된사용자' ),
	'LinkSearch'                => array( '링크검색', '링크찾기' ),
	'Listadmins'                => array( '관리자', '관리자목록' ),
	'Listbots'                  => array( '봇', '봇목록' ),
	'Listfiles'                 => array( '파일', '그림', '파일목록', '그림목록' ),
	'Listgrouprights'           => array( '사용자권한', '권한목록' ),
	'Listredirects'             => array( '넘겨주기목록' ),
	'ListDuplicatedFiles'       => array( '중복된파일목록' ),
	'Listusers'                 => array( '사용자', '사용자목록' ),
	'Lockdb'                    => array( 'DB잠금', 'DB잠그기' ),
	'Log'                       => array( '기록', '로그' ),
	'Lonelypages'               => array( '외톨이문서', '홀로된문서' ),
	'Longpages'                 => array( '긴문서' ),
	'MediaStatistics'           => array( '미디어통계' ),
	'MergeHistory'              => array( '역사합치기' ),
	'MIMEsearch'                => array( 'MIME검색', 'MIME찾기' ),
	'Mostcategories'            => array( '많이분류된문서' ),
	'Mostimages'                => array( '많이쓰는파일', '많이쓰는그림' ),
	'Mostinterwikis'            => array( '인터위키많은문서' ),
	'Mostlinked'                => array( '많이링크된문서' ),
	'Mostlinkedcategories'      => array( '많이쓰는분류' ),
	'Mostlinkedtemplates'       => array( '많이쓰는틀' ),
	'Mostrevisions'             => array( '역사긴문서' ),
	'Movepage'                  => array( '옮기기', '문서옮기기', '이동', '문서이동' ),
	'Mycontributions'           => array( '내기여', '내기여목록' ),
	'MyLanguage'                => array( '내언어' ),
	'Mypage'                    => array( '내사용자문서' ),
	'Mytalk'                    => array( '내사용자토론' ),
	'Myuploads'                 => array( '내가올린파일' ),
	'Newimages'                 => array( '새파일', '새그림' ),
	'Newpages'                  => array( '새문서' ),
	'PagesWithProp'             => array( '속성별문서' ),
	'PageLanguage'              => array( '문서언어' ),
	'PasswordReset'             => array( '비밀번호재설정', '비밀번호초기화' ),
	'PermanentLink'             => array( '고유링크', '영구링크' ),
	'Popularpages'              => array( '인기있는문서' ),
	'Preferences'               => array( '환경설정' ),
	'Prefixindex'               => array( '접두어찾기' ),
	'Protectedpages'            => array( '보호된문서' ),
	'Protectedtitles'           => array( '만들기보호된문서', '생성보호된문서' ),
	'Randompage'                => array( '임의문서' ),
	'RandomInCategory'          => array( '분류안의임의문서' ),
	'Randomredirect'            => array( '임의넘겨주기' ),
	'Recentchanges'             => array( '최근바뀜' ),
	'Recentchangeslinked'       => array( '링크최근바뀜' ),
	'Redirect'                  => array( '넘겨주기' ),
	'ResetTokens'               => array( '토큰재설정' ),
	'Revisiondelete'            => array( '특정판삭제' ),
	'RunJobs'                   => array( '작업실행' ),
	'Search'                    => array( '검색', '찾기' ),
	'Shortpages'                => array( '짧은문서' ),
	'Specialpages'              => array( '특수문서', '특수기능' ),
	'Statistics'                => array( '통계' ),
	'Tags'                      => array( '태그' ),
	'TrackingCategories'        => array( '추적용분류' ),
	'Unblock'                   => array( '차단해제' ),
	'Uncategorizedcategories'   => array( '분류안된분류' ),
	'Uncategorizedimages'       => array( '분류안된파일', '분류안된그림' ),
	'Uncategorizedpages'        => array( '분류안된문서' ),
	'Uncategorizedtemplates'    => array( '분류안된틀' ),
	'Undelete'                  => array( '삭제취소', '삭제된문서' ),
	'Unlockdb'                  => array( 'DB잠금취소', 'DB잠금해제' ),
	'Unusedcategories'          => array( '안쓰는분류', '쓰이지않는분류' ),
	'Unusedimages'              => array( '안쓰는파일', '안쓰는그림', '쓰이지않는파일', '쓰이지않는그림' ),
	'Unusedtemplates'           => array( '안쓰는틀', '쓰이지않는틀' ),
	'Unwatchedpages'            => array( '주시안되는문서' ),
	'Upload'                    => array( '올리기', '파일올리기', '그림올리기', '업로드' ),
	'UploadStash'               => array( '올린비공개파일', '비공개로올린파일' ),
	'Userlogin'                 => array( '로그인', '사용자로그인' ),
	'Userlogout'                => array( '로그아웃', '사용자로그아웃' ),
	'Userrights'                => array( '권한조정', '관리자하기', '봇하기' ),
	'Version'                   => array( '버전' ),
	'Wantedcategories'          => array( '필요한분류' ),
	'Wantedfiles'               => array( '필요한파일', '필요한그림' ),
	'Wantedpages'               => array( '필요한문서' ),
	'Wantedtemplates'           => array( '필요한틀' ),
	'Watchlist'                 => array( '주시문서목록', '주시목록' ),
	'Whatlinkshere'             => array( '가리키는문서', '링크하는문서' ),
	'Withoutinterwiki'          => array( '인터위키없는문서' ),
);

$magicWords = array(
	'redirect'                  => array( '0', '#넘겨주기', '#REDIRECT' ),
	'notoc'                     => array( '0', '__목차숨김__', '__NOTOC__' ),
	'nogallery'                 => array( '0', '__갤러리숨김__', '__화랑숨김__', '__NOGALLERY__' ),
	'forcetoc'                  => array( '0', '__목차보임__', '__목차표시__', '__FORCETOC__' ),
	'toc'                       => array( '0', '__목차__', '__TOC__' ),
	'noeditsection'             => array( '0', '__부분편집숨김__', '__문단편집숨김__', '__단락편집숨김__', '__NOEDITSECTION__' ),
	'currentmonth'              => array( '1', '현재월', 'CURRENTMONTH', 'CURRENTMONTH2' ),
	'currentmonth1'             => array( '1', '현재월1', 'CURRENTMONTH1' ),
	'currentmonthname'          => array( '1', '현재월이름', 'CURRENTMONTHNAME' ),
	'currentmonthnamegen'       => array( '1', '현재월이름소유격', 'CURRENTMONTHNAMEGEN' ),
	'currentmonthabbrev'        => array( '1', '현재월이름약자', 'CURRENTMONTHABBREV' ),
	'currentday'                => array( '1', '현재일', 'CURRENTDAY' ),
	'currentday2'               => array( '1', '현재일2', 'CURRENTDAY2' ),
	'currentdayname'            => array( '1', '현재요일', 'CURRENTDAYNAME' ),
	'currentyear'               => array( '1', '현재년', 'CURRENTYEAR' ),
	'currenttime'               => array( '1', '현재시각', '현재시분', 'CURRENTTIME' ),
	'currenthour'               => array( '1', '현재시', 'CURRENTHOUR' ),
	'localmonth'                => array( '1', '지역월', 'LOCALMONTH', 'LOCALMONTH2' ),
	'localmonth1'               => array( '1', '지역월1', 'LOCALMONTH1' ),
	'localmonthname'            => array( '1', '지역월이름', 'LOCALMONTHNAME' ),
	'localmonthnamegen'         => array( '1', '지역월이름소유격', 'LOCALMONTHNAMEGEN' ),
	'localmonthabbrev'          => array( '1', '지역월이름약자', 'LOCALMONTHABBREV' ),
	'localday'                  => array( '1', '지역일', 'LOCALDAY' ),
	'localday2'                 => array( '1', '지역일2', 'LOCALDAY2' ),
	'localdayname'              => array( '1', '지역요일', 'LOCALDAYNAME' ),
	'localyear'                 => array( '1', '지역년', 'LOCALYEAR' ),
	'localtime'                 => array( '1', '지역시분', '지역시각', 'LOCALTIME' ),
	'localhour'                 => array( '1', '지역시', 'LOCALHOUR' ),
	'numberofpages'             => array( '1', '모든문서수', 'NUMBEROFPAGES' ),
	'numberofarticles'          => array( '1', '문서수', 'NUMBEROFARTICLES' ),
	'numberoffiles'             => array( '1', '파일수', '그림수', 'NUMBEROFFILES' ),
	'numberofusers'             => array( '1', '사용자수', '계정수', 'NUMBEROFUSERS' ),
	'numberofactiveusers'       => array( '1', '활동중인사용자수', 'NUMBEROFACTIVEUSERS' ),
	'numberofedits'             => array( '1', '편집수', 'NUMBEROFEDITS' ),
	'pagename'                  => array( '1', '문서이름', 'PAGENAME' ),
	'pagenamee'                 => array( '1', '문서이름E', 'PAGENAMEE' ),
	'namespace'                 => array( '1', '이름공간', 'NAMESPACE' ),
	'namespacee'                => array( '1', '이름공간E', 'NAMESPACEE' ),
	'namespacenumber'           => array( '1', '이름공간수', 'NAMESPACENUMBER' ),
	'talkspace'                 => array( '1', '토론이름공간', 'TALKSPACE' ),
	'talkspacee'                => array( '1', '토론이름공간E', 'TALKSPACEE' ),
	'subjectspace'              => array( '1', '본문서이름공간', 'SUBJECTSPACE', 'ARTICLESPACE' ),
	'subjectspacee'             => array( '1', '본문서이름공간E', 'SUBJECTSPACEE', 'ARTICLESPACEE' ),
	'fullpagename'              => array( '1', '전체문서이름', 'FULLPAGENAME' ),
	'fullpagenamee'             => array( '1', '전체문서이름E', 'FULLPAGENAMEE' ),
	'subpagename'               => array( '1', '하위문서이름', 'SUBPAGENAME' ),
	'subpagenamee'              => array( '1', '하위문서이름E', 'SUBPAGENAMEE' ),
	'rootpagename'              => array( '1', '최상위문서이름', 'ROOTPAGENAME' ),
	'rootpagenamee'             => array( '1', '최상위문서이름E', 'ROOTPAGENAMEE' ),
	'basepagename'              => array( '1', '상위문서이름', 'BASEPAGENAME' ),
	'basepagenamee'             => array( '1', '상위문서이름E', 'BASEPAGENAMEE' ),
	'talkpagename'              => array( '1', '토론문서이름', 'TALKPAGENAME' ),
	'talkpagenamee'             => array( '1', '토론문서이름E', 'TALKPAGENAMEE' ),
	'subjectpagename'           => array( '1', '본문서이름', 'SUBJECTPAGENAME', 'ARTICLEPAGENAME' ),
	'subjectpagenamee'          => array( '1', '본문서이름E', 'SUBJECTPAGENAMEE', 'ARTICLEPAGENAMEE' ),
	'msg'                       => array( '0', '메시지:', 'MSG:' ),
	'subst'                     => array( '0', '풀기:', 'SUBST:' ),
	'safesubst'                 => array( '0', '안전풀기:', 'SAFESUBST:' ),
	'msgnw'                     => array( '0', '위키잘못메시지:', 'MSGNW:' ),
	'img_thumbnail'             => array( '1', '섬네일', '썸네일', '축소판', 'thumbnail', 'thumb' ),
	'img_manualthumb'           => array( '1', '섬네일=$1', '썸네일=$1', '축소판=$1', 'thumbnail=$1', 'thumb=$1' ),
	'img_right'                 => array( '1', '오른쪽', 'right' ),
	'img_left'                  => array( '1', '왼쪽', 'left' ),
	'img_none'                  => array( '1', '없음', 'none' ),
	'img_width'                 => array( '1', '$1픽셀', '$1px' ),
	'img_center'                => array( '1', '가운데', 'center', 'centre' ),
	'img_framed'                => array( '1', '프레임', 'framed', 'enframed', 'frame' ),
	'img_frameless'             => array( '1', '프레임없음', 'frameless' ),
	'img_lang'                  => array( '1', '언어=$1', 'lang=$1' ),
	'img_page'                  => array( '1', '문서=$1', 'page=$1', 'page $1' ),
	'img_upright'               => array( '1', '위오른쪽', '위오른쪽=$1', 'upright', 'upright=$1', 'upright $1' ),
	'img_border'                => array( '1', '테두리', 'border' ),
	'img_baseline'              => array( '1', '밑줄', 'baseline' ),
	'img_sub'                   => array( '1', '아래첨자', 'sub' ),
	'img_super'                 => array( '1', '위첨자', 'super', 'sup' ),
	'img_top'                   => array( '1', '위', 'top' ),
	'img_text_top'              => array( '1', '글자위', '텍스트위', 'text-top' ),
	'img_middle'                => array( '1', '중간', 'middle' ),
	'img_bottom'                => array( '1', '아래', 'bottom' ),
	'img_text_bottom'           => array( '1', '글자아래', '텍스트아래', 'text-bottom' ),
	'img_link'                  => array( '1', '링크=$1', 'link=$1' ),
	'img_alt'                   => array( '1', '대체글=$1', 'alt=$1' ),
	'img_class'                 => array( '1', '클래스=$1', 'class=$1' ),
	'int'                       => array( '0', '인터페이스:', 'INT:' ),
	'sitename'                  => array( '1', '사이트이름', 'SITENAME' ),
	'ns'                        => array( '0', '이름:', '이름공간:', 'NS:' ),
	'nse'                       => array( '0', '이름E:', '이름공간E:', 'NSE:' ),
	'localurl'                  => array( '0', '지역주소:', 'LOCALURL:' ),
	'localurle'                 => array( '0', '지역주소E:', 'LOCALURLE:' ),
	'articlepath'               => array( '0', '항목경로', '기사경로', 'ARTICLEPATH' ),
	'pageid'                    => array( '0', '문서번호', 'PAGEID' ),
	'server'                    => array( '0', '서버', 'SERVER' ),
	'servername'                => array( '0', '서버이름', 'SERVERNAME' ),
	'scriptpath'                => array( '0', '스크립트경로', 'SCRIPTPATH' ),
	'stylepath'                 => array( '0', '스타일경로', 'STYLEPATH' ),
	'grammar'                   => array( '0', '문법:', 'GRAMMAR:' ),
	'gender'                    => array( '0', '성별:', 'GENDER:' ),
	'notitleconvert'            => array( '0', '__제목변환없음__', '__제변없음__', '__제목변환안함__', '__제변안함__', '__NOTITLECONVERT__', '__NOTC__' ),
	'nocontentconvert'          => array( '0', '__내용변환없음__', '__내변없음__', '__내용변환안함__', '__내변안함__', '__NOCONTENTCONVERT__', '__NOCC__' ),
	'currentweek'               => array( '1', '현재주', 'CURRENTWEEK' ),
	'currentdow'                => array( '1', '현재요일숫자', 'CURRENTDOW' ),
	'localweek'                 => array( '1', '지역주', 'LOCALWEEK' ),
	'localdow'                  => array( '1', '지역요일숫자', 'LOCALDOW' ),
	'revisionid'                => array( '1', '판번호', 'REVISIONID' ),
	'revisionday'               => array( '1', '판일', 'REVISIONDAY' ),
	'revisionday2'              => array( '1', '판일2', 'REVISIONDAY2' ),
	'revisionmonth'             => array( '1', '판월', 'REVISIONMONTH' ),
	'revisionmonth1'            => array( '1', '판월1', 'REVISIONMONTH1' ),
	'revisionyear'              => array( '1', '판년', 'REVISIONYEAR' ),
	'revisiontimestamp'         => array( '1', '판타임스탬프', 'REVISIONTIMESTAMP' ),
	'revisionuser'              => array( '1', '판사용자', 'REVISIONUSER' ),
	'revisionsize'              => array( '1', '판크기', 'REVISIONSIZE' ),
	'plural'                    => array( '0', '복수:', '복수형:', 'PLURAL:' ),
	'fullurl'                   => array( '0', '전체주소:', 'FULLURL:' ),
	'fullurle'                  => array( '0', '전체주소E:', 'FULLURLE:' ),
	'canonicalurl'              => array( '0', '표준주소:', 'CANONICALURL:' ),
	'canonicalurle'             => array( '0', '표준주소E:', 'CANONICALURLE:' ),
	'lcfirst'                   => array( '0', '첫소문자:', 'LCFIRST:' ),
	'ucfirst'                   => array( '0', '첫대문자:', 'UCFIRST:' ),
	'lc'                        => array( '0', '소문자:', 'LC:' ),
	'uc'                        => array( '0', '대문자:', 'UC:' ),
	'raw'                       => array( '0', '원본:', 'RAW:' ),
	'displaytitle'              => array( '1', '보일제목', '표시제목', 'DISPLAYTITLE' ),
	'rawsuffix'                 => array( '1', '원', 'R' ),
	'nocommafysuffix'           => array( '0', '구분자없음', 'NOSEP' ),
	'newsectionlink'            => array( '1', '__새글쓰기__', '__NEWSECTIONLINK__' ),
	'nonewsectionlink'          => array( '1', '__새글쓰기숨기기__', '__NONEWSECTIONLINK__' ),
	'currentversion'            => array( '1', '현재버전', 'CURRENTVERSION' ),
	'urlencode'                 => array( '0', '주소인코딩:', 'URLENCODE:' ),
	'anchorencode'              => array( '0', '책갈피인코딩', 'ANCHORENCODE' ),
	'currenttimestamp'          => array( '1', '현재타임스탬프', 'CURRENTTIMESTAMP' ),
	'localtimestamp'            => array( '1', '지역타임스탬프', 'LOCALTIMESTAMP' ),
	'directionmark'             => array( '1', '명령검토', 'DIRECTIONMARK', 'DIRMARK' ),
	'language'                  => array( '0', '#언어:', '#LANGUAGE:' ),
	'contentlanguage'           => array( '1', '기본언어', 'CONTENTLANGUAGE', 'CONTENTLANG' ),
	'pagesinnamespace'          => array( '1', '이름공간문서수', 'PAGESINNAMESPACE:', 'PAGESINNS:' ),
	'numberofadmins'            => array( '1', '관리자수', 'NUMBEROFADMINS' ),
	'formatnum'                 => array( '0', '수형식', 'FORMATNUM' ),
	'padleft'                   => array( '0', '대체왼쪽', 'PADLEFT' ),
	'padright'                  => array( '0', '대체오른쪽', 'PADRIGHT' ),
	'special'                   => array( '0', '특수기능', 'special' ),
	'speciale'                  => array( '0', '특수기능E', '특수기능e', 'speciale' ),
	'defaultsort'               => array( '1', '기본정렬:', 'DEFAULTSORT:', 'DEFAULTSORTKEY:', 'DEFAULTCATEGORYSORT:' ),
	'filepath'                  => array( '0', '파일경로:', '그림경로:', 'FILEPATH:' ),
	'tag'                       => array( '0', '태그', 'tag' ),
	'hiddencat'                 => array( '1', '__숨은분류__', '__HIDDENCAT__' ),
	'pagesincategory'           => array( '1', '분류문서수', 'PAGESINCATEGORY', 'PAGESINCAT' ),
	'pagesize'                  => array( '1', '문서크기', 'PAGESIZE' ),
	'index'                     => array( '1', '__색인__', '__INDEX__' ),
	'noindex'                   => array( '1', '__색인안함__', '__색인거부__', '__NOINDEX__' ),
	'numberingroup'             => array( '1', '권한별사용자수', '그룹별사용자수', 'NUMBERINGROUP', 'NUMINGROUP' ),
	'staticredirect'            => array( '1', '__넘겨주기고정__', '__STATICREDIRECT__' ),
	'protectionlevel'           => array( '1', '보호수준', 'PROTECTIONLEVEL' ),
	'cascadingsources'          => array( '1', '계단식원본', 'CASCADINGSOURCES' ),
	'formatdate'                => array( '0', '날짜형식', 'formatdate', 'dateformat' ),
	'url_path'                  => array( '0', '경로', 'PATH' ),
	'url_wiki'                  => array( '0', '위키', 'WIKI' ),
	'url_query'                 => array( '0', '쿼리', 'QUERY' ),
	'defaultsort_noerror'       => array( '0', '오류없음', 'noerror' ),
	'defaultsort_noreplace'     => array( '0', '바꾸기없음', 'noreplace' ),
	'pagesincategory_all'       => array( '0', '모두', 'all' ),
	'pagesincategory_pages'     => array( '0', '문서', 'pages' ),
	'pagesincategory_subcats'   => array( '0', '하위분류', 'subcats' ),
	'pagesincategory_files'     => array( '0', '파일', 'files' ),
);

$bookstoreList = array(
	'Aladdin.co.kr' => 'http://www.aladdin.co.kr/catalog/book.asp?ISBN=$1',
	'inherit' => true,
);

$datePreferences = array(
	'default',
	'ISO 8601',
);
$defaultDateFormat = 'ko';
$dateFormats = array(
	'ko time'            => 'H:i',
	'ko date'            => 'Y년 M월 j일 (D)',
	'ko both'            => 'Y년 M월 j일 (D) H:i',
);

