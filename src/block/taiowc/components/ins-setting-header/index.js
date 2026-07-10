/**
 * External dependencies.
 */
import classnames from 'classnames';

/**
 * WordPress dependencies.
 */
import { __ } from '@wordpress/i18n';

import {
  Button,
  PanelBody
} from '@wordpress/components';

import { IoEllipsisVerticalCircleOutline, IoColorPaletteOutline } from 'react-icons/io5';


/**
 * Internal dependencies.
 */

const InsSettingHeader = ({
  value,
  options,
  onChange
}) => {
  

  return (
    <PanelBody className="th-setting-header">
      {options.map((option, index) => {
        return (
          <div key={index} className='th-tab-wrap'>
            <Button
              key={index}
              className={classnames({
                'is-active': option.value === value
              })}
              onClick={() => onChange(option.value)}
             >
              {option.label}
            </Button>
          </div>
        );
      })}
    </PanelBody>
  );
};

export default InsSettingHeader;
