import { fontIcons } from '../fontAwsomeIcon'
import './assets/css/socialRepeateater.scss';

export function IconPopup(props) { //index={props.index} iconDataChangeHandle={props.iconDataChangeHandle} hidePopup={hidePopup}
    const handelIconClickInPopUp = (e) => {
        const spanEle = e.target.closest('span');
        const iconId = spanEle.getAttribute('icon-id');
        spanEle.classList.add('active');
        props.dataChangeHandle(iconId,props.input[1],props.index)        
    }
    return (
        <div className='gf-social-icons-selection-popup-wrapper'>
            <div className='gf-social-icons-selection-popup '>
                <p className='title'>Icon name</p>
                <span className='gf-social-icons-cross-popup' onClick={props.hidePopup}>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z" />
                    </svg>
                </span>
                <div className='gf-social-icons-list'>
                    {Object.keys(fontIcons).map((icon) => (
                        <span
                            icon-id={icon}
                            key={icon} className='gf-social-icons-single-icon'
                            onClick={
                                handelIconClickInPopUp
                            }
                        >
                            {fontIcons[icon].icon}
                        </span>
                    ))}
                </div>
            </div>

        </div >
    );
}