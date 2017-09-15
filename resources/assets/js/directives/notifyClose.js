export default {
  bind(el) {
    const button = el;

    el.addEventListener('click', () => {
      button.parentNode.style.display = 'none';
    }, false);
  },
};
