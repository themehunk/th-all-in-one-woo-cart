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

    const adminUrlsearch = ThBlockData.adminUrlsearch;

    return (<Fragment>
        <InspectorControls>
        <PanelBody
					title={ __( 'All In One Woo Cart', 'taiowc' ) }
					initialOpen={true}
					className="th-sEARCH-panel"
				>   
        {/* <SelectControl
								label={ __( 'Search Style', 'taiowc' ) }
								value={ attributes.searchStyle }
								options={ [
									{ label: __( 'Default', 'taiowc' ), value: '[th-aps]' },
									{ label: __( 'bar-style', 'taiowc' ), value: '[th-aps layout="bar_style"]' },
									{ label: __( 'icon-style', 'taiowc' ), value: '[th-aps layout="icon_style"]' },
								    { label: __( 'flexible-style', 'taiowc' ), value: '[th-aps layout="flexible-style"]' },
								] }
								onChange={ e => setAttributes({ searchStyle: e }) }
							/> */}
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
                            href={adminUrlsearch}
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
