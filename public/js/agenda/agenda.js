let $modal;


let $doctor,$date,$horas;
let iRadio;


$(function () {
    $especialidad = $('#especialidad');
    $doctor=$('#medico');
    $date=$('#date');
    $horas=$('#horas');
    $especialidad.change(() => {
      const espeId = $especialidad.val();
      const url = `/especialidades/${espeId}/medicos`;
      $.getJSON(url, cargarMedicos);
    });
  

    $doctor.change(cargarHoras);
    $date.change(cargarHoras);


  });    
  
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('agenda');
    let formulario = document.querySelector("form");
    $modal=$('#citaM');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale:"es",
      headerToolbar:{
          left: 'prev,next today',
          center:'title',
          right:'dayGridMonth,timeGridWeek,listWeek'
      },


      
      events: "http://127.0.0.1:8000/agenda/mostrar" ,
        
        
       /*  const url = "/agenda/mostrar"
        fetch(url)
          .then(response => response.json()).then(data => {
            console.log(data)
              for (var i=0; i<data.length;i++){
                [{
                  start:'data[i].fecha_cita'
                }]
              }
          });   */
       //},



       dateClick:function(info){
        formulario.reset();

        formulario.fecha_cita=info.date;
        $modal.modal("show");
      } 

     
    });


    calendar.render();

    document.getElementById("btnGuardar").addEventListener("click",function(){
        $modal.modal("hide");
    });
});

  
function cargarMedicos(medicos) {
    let htmlOptions = '';
    medicos.forEach(medico => {
      htmlOptions += `<option value="${medico.id}">${medico.apellidos}</option>`;
    });
    $doctor.html(htmlOptions);
    cargarHoras();
  }

function cargarHoras(){
    const selectFecha= $date.val();
    const medicoId=$doctor.val();
    const url = `/horarios/horas?fecha=${selectFecha}&medico_id=${medicoId}`;
    $.getJSON(url, mostrarHoras);
  }


  function mostrarHoras(data){
    console.log(data);
    if(!data.mñn && !data.tarde){
        $horas.html(alertaHoras);
        return;
    }

    let htmlHoras = '';
    iRadio = 0;
  

    if(data.mñn){
      const intervalosMñn=data.mñn;
      intervalosMñn.forEach(intervalo=>{
        htmlHoras += mostrarRadioIntervalHtml(intervalo);
      });
    }

    if(data.tarde){
      const intervalosTarde=data.tarde;
      intervalosTarde.forEach(intervalo=>{
      	htmlHoras += mostrarRadioIntervalHtml(intervalo);
      });
    }

    $horas.html(htmlHoras);
  }

  

  function mostrarRadioIntervalHtml(interval) {
    const text = `${interval.inicio} - ${interval.fin}`;
  
    return `<div class="custom-control custom-radio mb-2">
    <input name="hora_cita" value="${interval.inicio}" class="custom-control-input" id="interval${iRadio}" type="radio" required>
    <label class="custom-control-label" for="interval${iRadio++}">${text}</label>
  </div>`;
  }