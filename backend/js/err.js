var w = ["|","\\","?","*","<","\"",":",">","+","[","]","/"];
var l = ["/"];
var d = ["/",":"];
var currError;
window.onload = function() {
	window['error'] = document.getElementsByClassName('error')[0];
	document.getElementById('title').oninput = function() {
		var osval = os.getAttribute('value');
		var current = window[osval.substr(0,1).toLowerCase()];
		error.innerHTML = "Sorry, these characters can't be put in your title:  ";
		currError = [];
		for (var character in current) {
			var ch = current[character];
			if (this.value.indexOf(ch) !== -1) {
				currError.push(ch);
				error.style.display = "block";
				document.getElementById('publish').setAttribute('disabled', 'true');
			}
		}
		if (currError.length === 0) {
			error.style.display = "none";
			document.getElementById('publish').removeAttribute('disabled');
		}
		else
			error.innerHTML += currError.join(' , ');
	};
	document.getElementById('content').oninput = function() {
		document.getElementById('preview').innerHTML = marked(this.value);
	};
	document.getElementById('compose').onsubmit = function() {
		var content = document.getElementById('content');
		document.getElementById("html").value = marked(content.value);
	};
	document.getElementById('content').oninput();
	marked.setOptions({breaks:true});
};