/**
 * Created by Ely Bascoy on 7/12/17.
 */
$(document).ready(function () {
    let counter = 0;

    /**
     * Dynamically adds choice fields, assigning a value if provided.
     * @param event
     * @param choiceValue
     */
    let addChoiceField = function addChoiceField(choiceValue = null) {
        counter++;

        if (counter === 1) {
            $('#choices-form-group').removeAttr("style");
        }
        let newTextBoxDiv = $(document.createElement('div'))
            .attr("id", 'choice-div-' + counter)
            .attr("class", 'form-group');

        let formGroupHtml = '<label ' +
            'class="col-lg-2 control-label" ' +
            'for="choice-' + counter + '">' +
            'Choice ' + counter + '</label>' +
            '<div class="col-lg-10">' +
            '<input type="text" ' +
            'name="choices[]" id="choice-'
            + counter + '" ' +
            'class="form-control" ' +
            'placeholder="Enter new choice"';
        if (choiceValue !== null) {
            formGroupHtml += ' value="' + choiceValue + '"></div>';
        } else {
            formGroupHtml += '></div>';
        }
        newTextBoxDiv.after().html(formGroupHtml);
        newTextBoxDiv.appendTo("#choices-form-group");
    };

    // if we have old choice values, create and populate the fields
    if (typeof choices !== "undefined" && $.isArray(choices)) {
        for (let i = 0; i < choices.length; i++) {
            addChoiceField(choices[i]);
        }
    }

    // Add new choice fields dynamically
    $("#choice-button").click(function() {
        addChoiceField();
    });
});