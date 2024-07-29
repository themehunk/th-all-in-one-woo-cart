import { __ } from '@wordpress/i18n';
import {AlignmentToolbar, __experimentalColorGradientControl as ColorGradientControl,InspectorControls} from '@wordpress/block-editor';

import {
    PanelBody,
    ToggleControl,SelectControl
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
                        <ToggleControl
								label={ __( 'Display Total Price', 'taiowcp' ) }
								checked={ attributes.cartPrice }
								onChange={ cartPrice => setAttributes({cartPrice}) }
							 />
                        <ToggleControl
								label={  __( 'Display Product Count', 'taiowcp' ) }
								checked={ attributes.cartCount }
								onChange={ cartCount => setAttributes({cartCount}) }
							 />

                            <SelectControl
								label={ __( 'Count Position', 'taiowcp' ) }
								value={ attributes.countPosition }
								options={ [
									{ label: __( 'Left', 'taiowcp' ), value: 'left' },
									{ label: __( 'Right', 'taiowcp' ), value: 'right' },
								] }
								onChange={ e => setAttributes({ countPosition: e }) }
							/>     
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
