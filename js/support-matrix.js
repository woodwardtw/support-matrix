console.log('button game on')


if (document.querySelector('#hide-students')){
	const studentHider = document.querySelector('#hide-students');
	studentHider.addEventListener('click', doTheHiding);
}


function doTheHiding(){
	const students = document.querySelectorAll('.student-row');
	students.forEach(function(row){
  		row.classList.toggle('hide')
	})
}