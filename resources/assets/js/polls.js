/**
 * Created by Ely Bascoy on 7/12/17.
 */

$(document).ready(function(){
    var counter = 0;

    $("#choice-button").click(function () {

        counter++;

        if (counter === 1) {
            $('#choices-form-group').removeAttr("style");
        }
        var newTextBoxDiv = $(document.createElement('div'))
            .attr("id", 'choice-div-' + counter)
            .attr("class", 'form-group');

        newTextBoxDiv.after().html('<label ' +
            'class="col-lg-2 control-label" ' +
            'for="choice-' + counter + '">' +
            'Choice ' + counter + '</label>' +
            '<div class="col-lg-10">' +
            '<input type="text" ' +
            'name="choices[]" id="choice-'
            + counter + '" ' +
            'class="form-control" ' +
            'value="" placeholder="Enter new choice"></div>');

        newTextBoxDiv.appendTo("#choices-form-group");
    });
});