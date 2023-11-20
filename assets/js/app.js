import '../css/app.scss';
import 'bootstrap';


document.addEventListener('DOMContentLoaded', () => {
  enableDropdowns();
});


const enableDropdowns = () => {
  const dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
  dropdownElementList.map(function (dropdownToggleEl) {
      return new Dropdown(dropdownToggleEl);
  });
}
