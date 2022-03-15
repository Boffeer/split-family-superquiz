let defaultNotValue = "-";
$(document).ready(function () {
  // DATEPICKER
  $(".datepicker").inputmask("99/99/9999");
  $(".datepicker").datepicker({
    format: "dd/mm/yyyy",
    weekStart: 1,
    endDate: new Date(),
    language: "ru",
  });

  /**
   * Next question picker
   */
  $('input[type="number"]').inputSpinner();

  var $questionButtons = $(".question__button");

  $(".question__anchor").each(function () {
    $(this).on("click", function () {
      let oppositeButton = $(this).siblings(".question__button");
      $(this).addClass("question__button--current");
      oppositeButton.removeClass("question__button--current");
      setTimeout(() => {
        $(this).removeClass("question__button--current");
      }, 10);
    });
  });

  function getCurrentQuestoinNode($button) {
    $($button).on("click", function () {
      let clickedButton = $(this);
      let oppositeButton = $(this).siblings(".question__button");
      let nextQuestionClass = $(this).attr("data-next");
      let nextQuestion = $(`.${nextQuestionClass}`);
      let oppositeQuestion = $(`.${oppositeButton.attr("data-next")}`);
      var isInputValid = true;

      const moveQuestion = () => {
        $(this).addClass("question__button--current");
        oppositeButton.removeClass("question__button--current");
        $(this)
          .prev(".question__anchor")
          .removeClass("question__button--current");

        $(".questions-vault").append(oppositeQuestion);
        $(".question").removeClass("question--current");
        oppositeQuestion.removeClass("question--visible");
        oppositeQuestion
          .find(".question__button--current")
          .removeClass("question__button--current");
        nextQuestion.insertAfter($(this).parent());
        setTimeout(function () {
          nextQuestion.addClass("question--visible question--current");
        }, 200);
      };
      const questionScrolling = () => {
        setTimeout(function () {
          $("html, body").animate(
            { scrollTop: $(`.${nextQuestionClass}`).offset().top - 500 },
            200
          );
          // console.log($(`.${nextQuestionClass}`).offset().top)
        }, 210);
      };

      let currentQuestionIndex = clickedButton.parent().index();
      clickedButton
        .parent()
        .parent()
        .children()
        .each(function (index, htmlElement) {
          if (index <= currentQuestionIndex + 1) {
          } else {
            $(".questions-vault").append($(htmlElement));
          }
        });

      const copyQuestionInputValue = () => {
        let inputName = clickedButton.parent().attr("data-name");
        if (clickedButton.hasClass("question__button--pager")) {
          // console.log('pager')
          let inputValue = $.trim(clickedButton.text());
          $(`input[name="${inputName}"]`).val(inputValue);
        } else if (clickedButton.hasClass("question__button--datepicker")) {
          let inputValue = clickedButton.prev().find("input").val();
          $(`input[name="${inputName}"]`).val(inputValue);
        } else if (clickedButton.hasClass("question__button--stepper")) {
          let inputValue = clickedButton
            .prev()
            .find(".form-control.question-stepper")
            .val();
          $(`input[name="${inputName}"]`).val(inputValue);
          if (inputName == "question-alimoney--your-expenses-children") {
            let inputValue = clickedButton.prev().prev().prev().val();
            let inputName = clickedButton.parent().attr("data-name");
            $(`input[name="${inputName}-about"]`).val(inputValue);
          }
        } else if (clickedButton.hasClass("question__button--stepper-alt")) {
          let inputValue = clickedButton.text();
          $(`input[name="${inputName}"]`).val(inputValue);
        } else if (clickedButton.hasClass("question__button--textarea")) {
          let inputValue = clickedButton.prev().val();
          if (inputValue != "") {
            $(`input[name="${inputName}"]`).val(inputValue);
          } else {
            $(`input[name="${inputName}"]`).val(defaultNotValue);
            // console.log('textaerea')
          }
        } else if (clickedButton.hasClass("question__button--textarea-alt")) {
          let inputValue = clickedButton.text();
          $(`input[name="${inputName}"]`).val(inputValue);
        } else if (clickedButton.hasClass("question__button--contacts")) {
          let inputCounter = 0;
          clickedButton
            .prev()
            .find("input")
            .each(function () {
              let contactInputName = $(this).attr("name");
              let contactInputValue = $(this).val();
              if (contactInputValue != "") {
                $(`.quiz-results input[name="${contactInputName}"]`).val(
                  contactInputValue
                );
                console.log(
                  `.quiz-results input[name="${contactInputName}"].val(${contactInputValue})`
                );
                console.log(inputCounter);
                $(this).removeClass("question-input--invalid");
                if (
                  clickedButton.hasClass("question__button--complete") &&
                  inputCounter === 0
                ) {
                  inputCounter++;
                  setTimeout(function () {
                    // $('.quiz-results').trigger('submit');
                    // dataLayer.push({"event": "formsend"});
                    // console.log('form submitted')
                  }, 100);
                }
              } else {
                isInputValid = false;
                $(this).addClass("question-input--invalid");
              }
            });
        }
      };

      // Обуление значений при смене ветки
      $(`input[name="${clickedButton.parent().attr("data-name")}"]`)
        .nextAll()
        .val(defaultNotValue);

      copyQuestionInputValue();
      if (isInputValid) {
        moveQuestion();
        questionScrolling();
      }
      if (clickedButton.parent().hasClass("question-alimoney--amount")) {
        $(".question-alimoney--payer-official-income").removeClass(
          "question--current"
        );
        $(".question-alimoney--payer-official-income").removeClass(
          "question--visible"
        );
      }
    });
  }

  $("textarea").each(function () {
    $(this).on("change input", function () {
      // console.log($(this).val(), $(this).parent())
      let inputName = $(this).parent().attr("data-name");
      let inputValue = $(this).val();

      if (inputValue.length >= 3) {
        // next find button
        // $(this).next().removeAttr('disabled');
        $(this).nextAll(".question__button--yes").removeAttr("disabled");
      } else {
        $(this).nextAll(".question__button--yes").attr("disabled", "disabled");
      }
      $(`input[name=${inputName}]`).val(inputValue);
    });
  });
  $(".question-stepper").each(function () {
    $(this).on("change input", function () {
      let inputName = $(this).parent().attr("data-name");
      let inputValue = $(this).val();
      $(`input[name=${inputName}]`).val(inputValue);
    });
  });

  getCurrentQuestoinNode($questionButtons);

  $(".datepicker").each(function () {
    $(this).on("change input", function () {
      if ($(this).inputmask("isComplete")) {
        // console.log($(this).val().length)
        $(this).parent().next().removeAttr("disabled");
      }
      if (/\d{2}\/\d{2}\/\d{4}/.test($(this).val())) {
        $(this).parent().next().removeAttr("disabled");
        // console.log($(this).parent().next(), 'regular')
      }
    });
    $(this).on("blur", function () {
      if (/\d{2}\/\d{2}\/\d{4}/.test($(this).val())) {
        $(this).parent().next().removeAttr("disabled");
        // console.log($(this).parent().next(), 'regular')
      } else {
        $(this).parent().next().attr("disabled", "disabled");
      }
    });
  });

  $('[data-toggle="tooltip"]').tooltip();

  /**
   * AJAX SEND
   */
  var formSubmitted = 0;
  $(".quiz-results").each(function () {
    if (formSubmitted == 0) {
      $(this).on("submit", function (event) {
        event.preventDefault();
        let question_divorce__plan = $(this).find(
          'input[name="question-divorce--plan"]'
        );
        let question_divorce__relations = $(this).find(
          'input[name="question-divorce--relations"]'
        );
        let question_divorce__divorce_date = $(this).find(
          'input[name="question-divorce--divorce-date"]'
        );
        let question_divorce__date_no_relations = $(this).find(
          'input[name="question-divorce--date-no-relations"]'
        );
        let question_divorce__together = $(this).find(
          'input[name="question-divorce--together"]'
        );
        let question_children__have = $(this).find(
          'input[name="question-children--have"]'
        );
        let question_children__age = $(this).find(
          'input[name="question-children--age"]'
        );
        let question_children__live_with_you = $(this).find(
          'input[name="question-children--live-with-you"]'
        );
        let question_children__dispute_livingplace = $(this).find(
          'input[name="question-children--dispute-livingplace"]'
        );
        let question_children__livingplace_list = $(this).find(
          'input[name="question-children--livingplace-list"]'
        );
        let question_children__dispute_communication = $(this).find(
          'input[name="question-children--dispute-communication"]'
        );
        let question_children__communication_schedule = $(this).find(
          'input[name="question-children--communication-schedule"]'
        );
        let question_alimoney__dispute = $(this).find(
          'input[name="question-alimoney--dispute"]'
        );
        let question_alimoney__recovered = $(this).find(
          'input[name="question-alimoney--recovered"]'
        );
        let question_alimoney__amount = $(this).find(
          'input[name="question-alimoney--amount"]'
        );
        let question_alimoney__payer_official_income = $(this).find(
          'input[name="question-alimoney--payer-official-income"]'
        );
        let question_alimoney__payer_income = $(this).find(
          'input[name="question-alimoney--payer-income"]'
        );
        let question_alimoney__payer_unofficial = $(this).find(
          'input[name="question-alimoney--payer-unofficial"]'
        );
        let question_alimoney__payer_unemployed = $(this).find(
          'input[name="question-alimoney--payer-unemployed"]'
        );
        let question_alimoney__payer_businessman = $(this).find(
          'input[name="question-alimoney--payer-businessman"]'
        );
        let question_alimoney__payer_credit = $(this).find(
          'input[name="question-alimoney--payer-credit"]'
        );
        let question_alimoney__dispute_result = $(this).find(
          'input[name="question-alimoney--dispute-result"]'
        );
        let question_alimoney__payer_children_amount = $(this).find(
          'input[name="question-alimoney--payer-children-amount"]'
        );
        let question_alimoney__your_additional_expenses = $(this).find(
          'input[name="question-alimoney--your-additional-expenses"]'
        );
        let question_alimoney__your_expenses_education = $(this).find(
          'input[name="question-alimoney--your-expenses-education"]'
        );
        let question_alimoney__your_expenses_rehabilitation = $(this).find(
          'input[name="question-alimoney--your-expenses-rehabilitation"]'
        );
        let question_alimoney__your_expenses_home = $(this).find(
          'input[name="question-alimoney--your-expenses-home"]'
        );
        let question_alimoney__your_expenses_children = $(this).find(
          'input[name="question-alimoney--your-expenses-children"]'
        );
        let question_alimoney__your_expenses_children_about = $(this).find(
          'input[name="question-alimoney--your-expenses-children-about"]'
        );
        let question_alimoney__maintenanse = $(this).find(
          'input[name="question-alimoney--maintenanse"]'
        );
        let question_alimoney__little_children = $(this).find(
          'input[name="question-alimoney--little-children"]'
        );
        let question_alimoney__maintenanse_disabled = $(this).find(
          'input[name="question-alimoney--maintenanse-disabled"]'
        );
        let question_alimoney__you_disabled = $(this).find(
          'input[name="question-alimoney--you-disabled"]'
        );
        let question_alimoney__you_need_help = $(this).find(
          'input[name="question-alimoney--you-need-help"]'
        );
        let question_alimoney__maintenanse_amount = $(this).find(
          'input[name="question-alimoney--maintenanse-amount"]'
        );
        let question_money__jointly_property = $(this).find(
          'input[name="question-money--jointly-property"]'
        );
        let question_money__disput_moments = $(this).find(
          'input[name="question-money--disput-moments"]'
        );
        let question_money__marriage_agreement = $(this).find(
          'input[name="question-money--marriage-agreement"]'
        );
        let question_money__jointly_property_list = $(this).find(
          'input[name="question-money--jointly-property-list"]'
        );
        let question_money__jointly_property_cost = $(this).find(
          'input[name="question-money--jointly-property-cost"]'
        );
        let question_money__jointly_money = $(this).find(
          'input[name="question-money--jointly-money"]'
        );
        let question_money__maternity_capital = $(this).find(
          'input[name="question-money--maternity-capital"]'
        );
        let question_money__wifes_personal = $(this).find(
          'input[name="question-money--wifes-personal"]'
        );
        let question_money__mans_personal = $(this).find(
          'input[name="question-money--mans-personal"]'
        );
        let question_money__credit_money = $(this).find(
          'input[name="question-money--credit-money"]'
        );
        let question_money__repaired_estate = $(this).find(
          'input[name="question-money--repaired-estate"]'
        );
        let question_money__repaired_estate_cost = $(this).find(
          'input[name="question-money--repaired-estate-cost"]'
        );
        let question_money__repaired_estate_additional_cost = $(this).find(
          'input[name="question-money--repaired-estate-additional-cost"]'
        );
        let question_money__repaired_estate_jointly = $(this).find(
          'input[name="question-money--repaired-estate-jointly"]'
        );
        let question_money__repaired_estate_maternity = $(this).find(
          'input[name="question-money--repaired-estate-maternity"]'
        );
        let question_money__repaired_estate_wifes_personal = $(this).find(
          'input[name="question-money--repaired-estate-wifes-personal"]'
        );
        let question_money__repaired_estate_mans_personal = $(this).find(
          'input[name="question-money--repaired-estate-mans-personal"]'
        );
        let question_money__repaired_estate_credit = $(this).find(
          'input[name="question-money--repaired-estate-credit"]'
        );
        let question_credits__obligations = $(this).find(
          'input[name="question-credits--obligations"]'
        );
        let question_credits__obligations_target = $(this).find(
          'input[name="question-credits--obligations-target"]'
        );
        let question_credits__obligations_rest = $(this).find(
          'input[name="question-credits--obligations-rest"]'
        );
        let question_credits__obligations_payer = $(this).find(
          'input[name="question-credits--obligations-payer"]'
        );
        let question_credits__property_division = $(this).find(
          'input[name="question-credits--property-division"]'
        );
        let user_name = $(this).find('input[name="user-name"]');
        let user_tel = $(this).find('input[name="user-tel"]');
        let user_email = $(this).find('input[name="user-email"]');
        let spouse_name = $(this).find('input[name="spouse-name"]');
        let spouse_tel = $(this).find('input[name="spouse-tel"]');
        let spouse_email = $(this).find('input[name="spouse-email"]');

        // console.log('аякс пошел', user_name.val(), user_tel.val(), user_email.val(), $(this));

        let formElements = [];
        let formFields = Array.from(event.target.elements);
        formFields.forEach((input) => {
          let inputName = input.getAttribute("name").replaceAll("-", "_");
          formElements[inputName] = input.value;
        });
        console.log(formElements);

        $.ajax({
          // url: "send.php",
          type: "POST",
          dataType: "json",
          data: {
            question_divorce__plan: question_divorce__plan.val(),
            question_divorce__relations: question_divorce__relations.val(),
            question_divorce__divorce_date:
              question_divorce__divorce_date.val(),
            question_divorce__date_no_relations:
              question_divorce__date_no_relations.val(),
            question_divorce__together: question_divorce__together.val(),
            question_children__have: question_children__have.val(),
            question_children__age: question_children__age.val(),
            question_children__live_with_you:
              question_children__live_with_you.val(),
            question_children__dispute_livingplace:
              question_children__dispute_livingplace.val(),
            question_children__livingplace_list:
              question_children__livingplace_list.val(),
            question_children__dispute_communication:
              question_children__dispute_communication.val(),
            question_children__communication_schedule:
              question_children__communication_schedule.val(),
            question_alimoney__dispute: question_alimoney__dispute.val(),
            question_alimoney__recovered: question_alimoney__recovered.val(),
            question_alimoney__amount: question_alimoney__amount.val(),
            question_alimoney__payer_official_income:
              question_alimoney__payer_official_income.val(),
            question_alimoney__payer_income:
              question_alimoney__payer_income.val(),
            question_alimoney__payer_unofficial:
              question_alimoney__payer_unofficial.val(),
            question_alimoney__payer_unemployed:
              question_alimoney__payer_unemployed.val(),
            question_alimoney__payer_businessman:
              question_alimoney__payer_businessman.val(),
            question_alimoney__payer_credit:
              question_alimoney__payer_credit.val(),
            question_alimoney__dispute_result:
              question_alimoney__dispute_result.val(),
            question_alimoney__payer_children_amount:
              question_alimoney__payer_children_amount.val(),
            question_alimoney__your_additional_expenses:
              question_alimoney__your_additional_expenses.val(),
            question_alimoney__your_expenses_education:
              question_alimoney__your_expenses_education.val(),
            question_alimoney__your_expenses_rehabilitation:
              question_alimoney__your_expenses_rehabilitation.val(),
            question_alimoney__your_expenses_home:
              question_alimoney__your_expenses_home.val(),
            question_alimoney__your_expenses_children:
              question_alimoney__your_expenses_children.val(),
            question_alimoney__your_expenses_children_about:
              question_alimoney__your_expenses_children_about.val(),
            question_alimoney__maintenanse:
              question_alimoney__maintenanse.val(),
            question_alimoney__little_children:
              question_alimoney__little_children.val(),
            question_alimoney__maintenanse_disabled:
              question_alimoney__maintenanse_disabled.val(),
            question_alimoney__you_disabled:
              question_alimoney__you_disabled.val(),
            question_alimoney__you_need_help:
              question_alimoney__you_need_help.val(),
            question_alimoney__maintenanse_amount:
              question_alimoney__maintenanse_amount.val(),
            question_money__jointly_property:
              question_money__jointly_property.val(),
            question_money__disput_moments:
              question_money__disput_moments.val(),
            question_money__marriage_agreement:
              question_money__marriage_agreement.val(),
            question_money__jointly_property_list:
              question_money__jointly_property_list.val(),
            question_money__jointly_property_cost:
              question_money__jointly_property_cost.val(),
            question_money__jointly_money: question_money__jointly_money.val(),
            question_money__maternity_capital:
              question_money__maternity_capital.val(),
            question_money__wifes_personal:
              question_money__wifes_personal.val(),
            question_money__mans_personal: question_money__mans_personal.val(),
            question_money__credit_money: question_money__credit_money.val(),
            question_money__repaired_estate:
              question_money__repaired_estate.val(),
            question_money__repaired_estate_cost:
              question_money__repaired_estate_cost.val(),
            question_money__repaired_estate_additional_cost:
              question_money__repaired_estate_additional_cost.val(),
            question_money__repaired_estate_jointly:
              question_money__repaired_estate_jointly.val(),
            question_money__repaired_estate_maternity:
              question_money__repaired_estate_maternity.val(),
            question_money__repaired_estate_wifes_personal:
              question_money__repaired_estate_wifes_personal.val(),
            question_money__repaired_estate_mans_personal:
              question_money__repaired_estate_mans_personal.val(),
            question_money__repaired_estate_credit:
              question_money__repaired_estate_credit.val(),
            question_credits__obligations: question_credits__obligations.val(),
            question_credits__obligations_target:
              question_credits__obligations_target.val(),
            question_credits__obligations_rest:
              question_credits__obligations_rest.val(),
            question_credits__obligations_payer:
              question_credits__obligations_payer.val(),
            question_credits__property_division:
              question_credits__property_division.val(),
            user_name: user_name.val(),
            user_tel: user_tel.val(),
            user_email: user_email.val(),
            spouse_name: spouse_name.val(),
            spouse_tel: spouse_tel.val(),
            spouse_email: spouse_email.val(),
          },
          success: function (data) {
            // console.table(data)
          },
        });
        // $(this)[0].reset();
        // console.log('отправляем')
        localStorage.removeItem(ANSWERS.localStorageName);
        // ym(82308838, "reachGoal", "form-submit");
        return false;
      });

      formSubmitted += 1;
    }
  });

  poppa({
    clickTrigger: ".tooltip--jointly",
    pop: ".pop-jointly",
    coolText: true,
  });
  poppa({
    clickTrigger: ".tooltip--personal",
    pop: ".pop-personal",
    coolText: true,
  });

  $("body").activity({
    achieveTime: 60,
    testPeriod: 10,
    useMultiMode: 1,
    callBack: function (e) {
      dataLayer.push({ event: "activity60s" });
    },
  });

  $(".question__button--complete").each(function () {
    $(this).on("click", function () {
      // console.log('отправка 1');
      $(".quiz-results").trigger("submit");
      dataLayer.push({ event: "formsend" });
    });
  });
});

let ANSWERS = {
  localStorageName: "splitFamilyAnswers",
  data: "",
  save: function () {
    ANSWERS.data = [];
    let lastButtonToClick = $(".questions-active.divorce")
      .find("article")
      .last()
      .attr("data-name");
    $(`.quiz-results input[name="${lastButtonToClick}"]`).val("last");

    $(".quiz-results input").each(function () {
      let currentValue = $(this).val();
      let currentName = $(this).attr("name");
      ANSWERS.data.push({ name: currentName, value: currentValue });
    });

    localStorage.setItem(
      ANSWERS.localStorageName,
      JSON.stringify(ANSWERS.data)
    );
  },
  get: function () {
    return JSON.parse(localStorage.getItem(ANSWERS.localStorageName));
  },
  reset: function () {
    localStorage.removeItem(ANSWERS.localStorageName);
  },
  check: function () {
    let answers = ANSWERS.get();
    answers.forEach((answer) => {
      if (answer.value != defaultNotValue) {
        // console.log(answer.value);
        $(`article.question.${answer.name}`).find("button");
      }
    });
  },
  getFiltered: function () {
    let filteredQuestions = ANSWERS.get().filter((answer) => {
      // return answer.value !== defaultNotValue;
      return (
        (answer.value !== defaultNotValue && answer.value !== "") ||
        answer.value == "last"
      );
    });
    return filteredQuestions;
  },
  restore: function () {
    let questionsToRestore = ANSWERS.getFiltered();

    // Need to load all questions after refres page
    let questionsToRestoreLength = questionsToRestore.length;
    // console.log(questionsToRestore)

    questionsToRestore.forEach((answer, index, answers) => {
      setTimeout(() => {
        // CLICK BUTTON TO CONTINUE
        // console.log(answers.length, index, answer)
        let answersLength = answers.length;
        if (index === --answersLength) {
          let buttonToClickName = answer.name;
          const buttonToClick = $(
            `article.question.${buttonToClickClass}`
          ).find(`button[data-next="${buttonToClickName}"]`);

          if (buttonToClick.attr("disabled")) {
            buttonToClick.removeAttr("disabled");
          }
          setTimeout(() => {
            buttonToClick.trigger("click");
          }, 10);
        } else {
          // INSERT INPUT VALUE
          $(`article.${answer.name}`).find("input").val(answer.value);
          $(`article.${answer.name}`).find("textarea").val(answer.value);

          let buttonToClickClass = answers[index].name;
          let buttonToClick = $(`article.question.${buttonToClickClass}`).find(
            `button[data-next="${answers[++index].name}"]`
          );

          if (buttonToClick.attr("disabled")) {
            buttonToClick.removeAttr("disabled");
          }
          setTimeout(() => {
            buttonToClick.trigger("click");
          }, 10);
        }
      }, 100);
    });
  },
};

function saveListener() {
  $(".quiz-results")
    .find("input")
    .each(function () {
      $(this).on("change", function () {
        ANSWERS.save();
        // console.log('saved')
      });
    });
}

// console.log(ANSWERS.get())
if (ANSWERS.get() === null) {
  ANSWERS.save();
  ANSWERS.data = ANSWERS.get();
} else {
  ANSWERS.data = ANSWERS.get();
  // ANSWERS.restore();
  // ANSWERS.save();
}
// $('.question').find('input').on('change', function() {
//   setTimeout(() => {
//     ANSWERS.save();
//   }, 310)
// })
// $('.question').find('textarea').on('change', function() {
//   setTimeout(() => {
//     ANSWERS.save();
//   }, 310)
// })
$(".question__button").on("click", function () {
  setTimeout(() => {
    ANSWERS.save();
    // console.log('saved')
  }, 310);
});

// $('.question__anchor').each(function() { let blockId = $(this).href();
//   $(this).on('click', function() {
//     preventDefault();
//     console.log('lf')
//     $("html, body").animate({ scrollTop: $(`#${blockId}`).offset().top }, 1000);
//   })
// })

ANSWERS.save();

const quizStarter = document.querySelector(".button__start-quiz");

quizStarter.addEventListener("click", async (event) => {
  let quizStarterData = {};
  const quizStarterCard = document.querySelector(
    ".question-credits--your-contacts"
  );
  quizStarterCard.querySelectorAll(".question-input").forEach((input) => {
    quizStarterData[input.getAttribute("name").replaceAll("-", "_")] = {
      question: input.getAttribute("data-question"),
      answer: input.value,
    };
  });

  let quizPayload = new URLSearchParams();

  for (key in quizStarterData) {
    quizPayload.append(key, quizStarterData[key]);
  }
  console.log(quizPayload.toString());

  const response = await fetch("begin-quiz.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(quizStarterData),
  });

  const json = await response.json();

  document.querySelector(".quiz-results__user-id").value = json.contact.data;
  document.querySelector(".quiz-results__deal-id").value = json.deal.data;
});
