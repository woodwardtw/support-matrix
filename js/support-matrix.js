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


//new version radio button ajax

if(document.getElementById('single-student')){
	console.log('student')
	let radios = document.querySelectorAll('input')
	for(radio in radios) {
    	radios[radio].onclick = function() {
       // alert(this.value);
        let status = this.value;
        let assessment = this.dataset.assessment;
        ajaxStatus(assessment, status);
    	}
	}
}


function ajaxStatus(assessment, status){
    var complete = 'this.value';
    // var assessment = radio.dataset.assessment;
    // var status = radio.value;
    // console.log(radio.value);
    // console.log(radio.dataset.assessment);
    jQuery.ajax({
        url : studentstatus.ajax_url,
        type : 'post',
        data : {
            action : 'update_student_status',  //php function that runs        
            complete : complete,  //variable passed to php and its name
            status :   status,   //variable passed to php and its name
            assessment : assessment,
        },
        success : function( response ) {
            alert('update success') //tells you it worked
        }
    });
}