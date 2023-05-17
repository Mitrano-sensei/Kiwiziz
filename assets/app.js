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

    var add_answer = document.getElementsByClassName('adding-answer');
    var add_answer_link = document.getElementsByClassName('add-answer-link');
    var answer_container = document.getElementsByClassName('answer-container');
    var answers_container = document.getElementsByClassName('answers-container');
    var answer_limit = 10;

    for (let i = 0; i < add_answer.length; i++) {
        add_answer_link[i].addEventListener('click', function () {

            var child = answers_container[i].firstElementChild
            var answer_clone = child.cloneNode(true);
            var container_size = answers_container[i].childElementCount;

            if (container_size < answer_limit) {

                var answer_input = answer_clone.getElementsByClassName('answer-field')[0];
                var answer_checkbox = answer_clone.getElementsByClassName('correct-field')[0];
                console.log(answer_input);

                answer_input.setAttribute('id', 'answer_' + i + '_' + container_size);
                answer_input.setAttribute('value', 'Answer ' + (container_size + 1));
                answer_input.setAttribute('name', 'answer[' + i + ']');
                answer_checkbox.checked = false;

                answers_container[i].appendChild(answer_clone);
            }

        });
    }


});

