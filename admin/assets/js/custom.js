
/*=============================================================
    Authour URI: www.binarytheme.com
    License: Commons Attribution 3.0

    http://creativecommons.org/licenses/by/3.0/

    100% Free To use For Personal And Commercial Use.
    IN EXCHANGE JUST GIVE US CREDITS AND TELL YOUR FRIENDS ABOUT US
   
    ========================================================  */

(function ($) {
    "use strict";
    var mainApp = {
        slide_fun: function () {

            $('#carousel-example').carousel({
                interval:3000 // THIS TIME IS IN MILLI SECONDS
            })

        },
        dataTable_fun: function () {

             $('#dataTables-example').dataTable();

        },

       
        custom_fun:function()
        {
            /*====================================
             WRITE YOUR   SCRIPTS  BELOW
            ======================================*/
         
            $('#example').dataTable({ //four column table
                autoWidth: false, //step 1
                columnDefs: [
                   { width: '5%', targets: 0 }, //step 2, column 1 out of 4
                   { width: '30%', targets: 1 }, //step 2, column 2 out of 4
                   { width: '30%', targets: 2 },  //step 2, column 3 out of 4
                   { width: '5%', targets: 3 },
                   { width: '5%', targets: 4 },
                   { width: '5%', targets: 5 },
                   { width: '10%', targets: 6 } 
                ]
             });





        },

    }
   
   
    $(document).ready(function () {
        mainApp.slide_fun();
         mainApp.dataTable_fun();
        mainApp.custom_fun();
    });
}(jQuery));


