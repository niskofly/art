document.addEventListener('DOMContentLoaded', function() {
  const options = {
    // родитель целевого элемента - область просмотра
    root: null,
    // без отступов
    rootMargin: '0px',
    // процент пересечения - половина изображения
    threshold: 0.5,
  };

  // создаем наблюдатель
  const observer = new IntersectionObserver((entries, observer) => {
    // для каждой записи-целевого элемента
    entries.forEach(entry => {
      // если элемент является наблюдаемым
      if (entry.isIntersecting) {
        const lazy = entry.target;
        // выводим информацию в консоль - проверка работоспособности наблюдателя
        // console.log(lazy);
        // меняем фон контейнера
        lazy.src = lazy.dataset.src;
        lazy.dataset.src = '';
        // прекращаем наблюдение
        observer.unobserve(lazy);
      }
    });
  }, options);

  // с помощью цикла следим за всеми элементами на странице
  for (let item of document.querySelectorAll('iframe, img, .lazyload')) {
    if (!item.dataset.src) {
      continue;
    }

    observer.observe(item);
  }

}, false);