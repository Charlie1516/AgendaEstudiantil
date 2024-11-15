// Validacion de formulario de Bootstrap
(() => {
    "use strict";

    // Selecciona todos los formularios que requieren validación
    const forms = document.querySelectorAll(".needs-validation");

    // Itera sobre cada formulario
    Array.from(forms).forEach((form) => {
        // Agrega un event listener para el evento "submit" en cada formulario
        form.addEventListener(
            "submit",
            (event) => {
                // Verifica si el formulario no es válido
                if (!form.checkValidity()) {
                    event.preventDefault(); // Previene la acción por defecto del evento
                    event.stopPropagation(); // Detiene la propagación del evento
                }

                // ES PARA LOS MENSAJES DE LA VALIDACION DE REGISTRO DE LA PELICULA
                form.classList.add("was-validated");
            },
            false
        );
    });
})();

// Manejo de eventos una vez que el DOM está listo
$(document).ready(function () {
    // Registrar pelicula

    const calendarData = {
        initialView: "dayGridMonth",
        height: "auto",
        firstDay: 1,
        events: "./api/agenda/list.php",
        locale: "es",
        buttonText: {
            today: "Hoy",
            month: "mes",
            year: "año",
            week: "semana",
            day: "dia",
        },
        titleFormat: {
            year: "numeric",
            month: "long",
            day: "numeric",
        },
        displayEventTime: true,
        eventTimeFormat: {
            hour: "2-digit",
            minute: "2-digit",
            meridiem: false,
        },
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "multiMonthYear,dayGridMonth,timeGridWeek,timeGridDay",
        },
        eventClick: function (info) {
            var eventObj = info.event;
            $("#event-title").text(eventObj.title);
            $("#event-type").text(eventObj.extendedProps.type);
            $("#event-description").text(eventObj.extendedProps.description);
            $("#event-date").text(eventObj.start.toLocaleDateString("es-ES", { year: "numeric", month: "long", day: "numeric", hour: "2-digit", minute: "2-digit" }));
            $("#event-fullname").text(eventObj.extendedProps.fullname);
            $("#delete-event").attr("event-id", eventObj.id);
            $("#showEventModal").modal("show");
        },
        dateClick: function (info) {
            $("#createEvent").modal("show");
            $("#date").val(info.dateStr + " 00:00");
        },
    };
    var calendarEl = document.getElementById("calendar");
    const calendar = new FullCalendar.Calendar(calendarEl, calendarData);
    calendar.render();

    $("#createEventForm").submit(function (e) {
        e.preventDefault(); // Previene la acción por defecto del evento "submit"
        if (this.checkValidity()) {
            // Verifica si el formulario es válido
            var data = {
                // Obtiene los datos del formulario
                title: $("#title").val(),
                date: $("#date").val(),
                description: $("#description").val(),
                type: $("#type").val(),
            };

            // Realiza una petición AJAX para registrar la película
            $.ajax({
                type: "POST",
                url: "./api/agenda/create.php",
                dataType: "json",
                data: data,
                success: function (response) {
                    alert(response.message); // Muestra un mensaje de éxito
                    $("#createEventForm")[0].reset(); // Limpia el formulario
                    $("#createEventForm").removeClass("was-validated"); // Remueve la clase de validación
                    $(".is-invalid").removeClass("is-invalid"); // Remueve las clases de error de validación
                    $("#createEvent").modal("hide");
                    calendar.refetchEvents();
                },
                error: function (xhr, status, error) {
                    // Maneja los errores de la petición AJAX
                    // console.log(xhr);
                    alert(xhr.responseJSON?.message ?? "Se produjo un error al intentar registrar la pelicula");
                },
            });
        }
    });
    $("#delete-event").click(function (e) {
        const eventId = $(this).attr("event-id");
        $.ajax({
            type: "POST",
            url: "./api/agenda/remove.php",
            dataType: "json",
            data: { id: eventId },
            success: function (response) {
                alert(response.message);
                $("#showEventModal").modal("hide");
                calendar.getEventById(eventId).remove();
            },
            error: function (xhr, status, error) {
                // Maneja los errores de la petición AJAX
                // console.log(xhr);
                alert(xhr.responseJSON?.message ?? "Se produjo un error al intentar registrar la pelicula");
            },
        });
    });
});
