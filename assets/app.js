import './styles/app.less';

var qid = "$QID$";
var aid = "$AID$";

var listTemplate = `<div class="question-container">
<div class="q-container">

	<div class="question-title-container">
		<input type="text" name="questionTitle$QID$" class="question-title-field" value="" placeholder="Title">
	</div>

	<div class="image-container">
		<label for="image$QID$" class="image-label">Background Image :
		</label>
		<input type="file" name="image$QID$" class="image-field" value="" placeholder="Image">
	</div>

	<div class="answers-container">
    <div class="answer-container">
					<label for="answer$QID$" class="answer-label">Answer :
					</label>
					<input type="text" name="answer$QID$" id="answer$QID$" class="answer-field" value="" placeholder="Answer">
				<input type="checkbox" name="correct$QID$" id="correct$QID$" class="correct-field" value="correct">
				<label for="correct$QID$" class="correct-label">Is Correct</label>
                    </div>
                    </div>

                    <div class="adding-answer">
                    <label for="add-answer-icon" class="add-answer-label">Add Answer : </label>
                    <a href="addanswer" class="add-answer-link">
                        <img src="src/add2.png" class="add-answer-icon">
                    </a>
            
                </div>
            
            </div>

<div class="adding-question">
    <span class="add-question-link">
        Add question :
        <img src="src/add.png" class="add-question-icon">
    </span>

    <div class="question-type-container">
        <input type="radio" name="questionType$QID$" id="image$QID$" class="question-type" value="image">
        <label for="image$QID$">Image</label>
        <input type="radio" name="questionType$QID$" id="list$QID$" class="question-type" value="list">
        <label for="list$QID$">List</label>
    </div>
</div>
</div>`;

var imageTemplate = `<div class="question-container">
<div class="q-container">

	<div class="question-title-container">
		<input type="text" name="questionTitle$QID$" class="question-title-field" value="" placeholder="Title">
	</div>

	<div class="image-container">
		<label for="image$QID$" class="image-label">Background Image :
		</label>
		<input type="file" name="image$QID$" class="image-field" value="" placeholder="Image">
	</div>

	<div class="answers-container">
    <div class="answer-container">
    <label for="answer$QID$" class="answer-label">Answer :
    </label>
    <input type="file" name="answer$QID$" id="answer$QID$" class="answer-field" value="" placeholder="Answer">
				<input type="checkbox" name="correct$QID$" class="correct-field" value="correct">
				<label for="correct$QID$" class="correct-label">Is Correct</label>
                    </div>
                    </div>

                    <div class="adding-answer">
                    <label for="add-answer-icon" class="add-answer-label">Add Answer : </label>
                    <a href="addanswer" class="add-answer-link">
                        <img src="src/add2.png" class="add-answer-icon">
                    </a>
            
                </div>
            
            </div>

<div class="adding-question">
    <span class="add-question-link">
        Add question :
        <img src="src/add.png" class="add-question-icon">
    </span>

    <div class="question-type-container">
        <input type="radio" name="questionType$QID$" id="image$QID$" class="question-type" value="image">
        <label for="image$QID$">Image</label>
        <input type="radio" name="questionType$QID$" id="list$QID$" class="question-type" value="list">
        <label for="list$QID$">List</label>
    </div>
</div>
</div>`;

document.addEventListener('DOMContentLoaded', function () {

    var add_question = document.getElementsByClassName('adding-question');
    var add_question_link = document.getElementsByClassName('add-question-link');
    var radioDiv = document.getElementsByClassName('question-type-container');
    var q_container = document.getElementsByClassName('question-container');
    var q_containers = document.getElementsByClassName('questions-container');

    for (let i = 0; i < add_question.length; i++) {
        add_question[i].addEventListener('mouseover', function () {
            add_question_link[i].setAttribute('style', 'display: flex');
        });
        add_question_link[i].addEventListener('click', function () {
            radioDiv[i].setAttribute('style', 'display: flex');
            radioDiv[i].addEventListener('click', function () {
                radioDiv[i].querySelectorAll('input[type="radio"]').forEach((el) => {
                    if (el.checked) {
                        if (el.value == 'list') {
                            var question_id = q_container.length + 1;
                            var node = listTemplate.replace(/\$QID\$/g, question_id).replace(/\$AID\$/g, 1);
                            //transform string to html element
                            var clone = document.createElement('div');
                            clone.innerHTML = node.trim();
                            clone = clone.firstChild;
                            //traitement pour les listes
                            q_containers[0].appendChild(clone);
                            el.checked = false;
                        }
                        else if (el.value == 'image') {
                            //traitement pour les images
                            var question_id = q_container.length + 1;
                            var node = imageTemplate.replace(/\$QID\$/g, question_id).replace(/\$AID\$/g, 1);
                            //transform string to html element
                            var clone = document.createElement('div');
                            clone.innerHTML = node.trim();
                            clone = clone.firstChild;
                            q_containers[0].appendChild(clone);
                            el.checked = false;
                        }
                    }
                });
            });
        });
        q_container[i].addEventListener('mouseleave', function () {
            radioDiv[i].setAttribute('style', 'display: none');
            add_question_link[i].setAttribute('style', 'display: none');
        });
    }

});