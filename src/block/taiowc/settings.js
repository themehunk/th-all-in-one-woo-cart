import { __ } from '@wordpress/i18n';
import {AlignmentToolbar, __experimentalColorGradientControl as ColorGradientControl,InspectorControls} from '@wordpress/block-editor';

import {
    PanelBody,
    RangeControl,
    SelectControl,
    Placeholder,
    Spinner,
    ToggleControl,
} from '@wordpress/components';

import { useSelect } from '@wordpress/data';
import {
	RichText
} from '@wordpress/block-editor';

import {
    Fragment,
    useState,
    Suspense
} from '@wordpress/element';

const InsSettings = ({
    attributes,
    setAttributes
}) => {

    const adminUrltaiowc = ThBlockDatataiowc.adminUrltaiowc;

    return (<Fragment>
        <InspectorControls>
        <PanelBody
					title={ __( 'All In One Woo Cart', 'taiowc' ) }
					initialOpen={true}
					className="th-sEARCH-panel"
				>   
       
                             <p>
                        {__(
                            'For the ',
                            'taiowc'
                        )}
                        <strong>{__('Advanced Options and Styling', 'taiowc')}</strong>
                           
                        {__(
                            ' navigate to ',
                            'taiowc'
                        )}
                        <a
                            href={adminUrltaiowc}
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            {__('Settings', 'taiowc')}
                        </a>
                    
                    </p>
                            </PanelBody>
        </InspectorControls>
    </Fragment>)   
}

export default InsSettings;
