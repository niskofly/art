document.addEventListener('DOMContentLoaded', function(event) {
	let links = document.getElementsByTagName('a');
	for (let i = 0; i < links.length; i++) {
		let link = links[i];
		link.href = link.href + '?zvezda';
	}
});
