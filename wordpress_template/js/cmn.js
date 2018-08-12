$(function () {
	$('div.gnavbtn').click(function () {
		$('div.zdo_drawer_bg').fadeToggle();
		$('nav.gnav').toggleClass('open');
	})
$('div.zdo_drawer_bg').click(function () {
		$(this).fadeOut();
		$('nav.gnav').removeClass('open');
	});
	
var bgImages = [
	'https://mangacoin.co.jp/wp-content/themes/wp01/img/back/01.jpg',
	'https://mangacoin.co.jp/wp-content/themes/wp01/img/back/02.jpg',
	'https://mangacoin.co.jp/wp-content/themes/wp01/img/back/03.jpg',
	'https://mangacoin.co.jp/wp-content/themes/wp01/img/back/04.jpg',
	'https://mangacoin.co.jp/wp-content/themes/wp01/img/back/05.jpg',
	'https://mangacoin.co.jp/wp-content/themes/wp01/img/back/06.jpg',
	'https://mangacoin.co.jp/wp-content/themes/wp01/img/back/07.jpg',
	'https://mangacoin.co.jp/wp-content/themes/wp01/img/back/08.jpg'
];
var randBg = bgImages[Math.floor(Math.random() * bgImages.length)];
$('section.topview').css('background-image', 'url(' + randBg + ')');
	
})