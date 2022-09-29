let faqExpand = document.querySelector('.card.faq');
  faqExpand.addEventListener('click', (X) => {
      if (X.target.classList.contains('pertanyaan')) {
          X.target.nextElementSibling.classList.toggle('expand');
          X.target.children[0].classList.toggle('rotate');
      }
  });