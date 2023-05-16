import './styles/app.less';

//dom ready
document.addEventListener('DOMContentLoaded', function () {

    var add_question = document.getElementsByClassName('adding-question');
    var add_question_link = document.getElementsByClassName('add-question-link');
    var radioDiv = document.getElementsByClassName('question-type-container');
    var q_container = document.getElementsByClassName('question-container');

    for (let i = 0; i < add_question.length; i++) {
        add_question[i].addEventListener('mouseover', function () {
            add_question_link[i].setAttribute('style', 'display: flex');
        });

        add_question_link[i].addEventListener('click', function () {
            radioDiv[i].setAttribute('style', 'display: flex');
        });     

        q_container[i].addEventListener('mouseleave', function () {
            radioDiv[i].setAttribute('style', 'display: none');
            add_question_link[i].setAttribute('style', 'display: none');
        });
    }

});