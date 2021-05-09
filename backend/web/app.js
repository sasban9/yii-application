// created by themethoft on 2021-05-10

$(function(){
    'use strict';
    $('#videoFile').change(ev => {
        $(ev.target).closest('form').trigger('submit');
    })
});