import { __ } from '@wordpress/i18n';
import {__experimentalColorGradientControl as ColorGradientControl,InspectorControls} from '@wordpress/block-editor';

import {
    PanelBody,
    ToggleControl,SelectControl,RangeControl
} from '@wordpress/components';

import { useSelect } from '@wordpress/data';

import {
    Fragment,
    useState
} from '@wordpress/element';

/**
* Internal dependencies
*/
import {
	InsSettingHeader,
	ResponsiveControl,
	SizingControl,
	ControlPanelControl,
	UnitChooser
} from './components/index.js';

const InsSettings = ({
    attributes,
    setAttributes
}) => {

    const adminUrltaiowc = ThBlockDatataiowc.adminUrltaiowc;
    const [ tab, setTab ] = useState( 'setting' );
    const getView = useSelect((select) => {
		// Device type selectors for different editors
		const siteEditorDeviceType = select('core/edit-site')?.getPreviewDeviceType?.(); // For Site Editor
		const blockEditorDeviceType = select('core/editor')?.getDeviceType?.(); // For Block/Post Editor
		// Fallback to your custom getView if neither device type is available
		return siteEditorDeviceType || blockEditorDeviceType;
	}, []);
    //padding
    const getPaddingType = () => {
        switch ( getView ) {
        case 'Desktop':
            return attributes.paddingType;
        case 'Tablet':
            return attributes.paddingTypeTablet;
        case 'Mobile':
            return attributes.paddingTypeMobile;
        default:
            return undefined;
        }
    };

    const changePaddingType = value => {
        if ( 'Desktop' === getView ) {
            setAttributes({ paddingType: value,paddingTypeTablet: value, paddingTypeMobile: value });
        } else if ( 'Tablet' === getView ) {
            setAttributes({ paddingTypeTablet: value,paddingTypeMobile: value });
        } else if ( 'Mobile' === getView ) {
            setAttributes({ paddingTypeMobile: value });
        }
    };
const desktopPaddingType = {
    top: 'paddingTop',
    right: 'paddingRight',
    bottom: 'paddingBottom',
    left: 'paddingLeft'
};
const tabletPaddingType = {
    top: 'paddingTopTablet',
    right: 'paddingRightTablet',
    bottom: 'paddingBottomTablet',
    left: 'paddingLeftTablet'
};
const mobilePaddingType = {
    top: 'paddingTopMobile',
    right: 'paddingRightMobile',
    bottom: 'paddingBottomMobile',
    left: 'paddingLeftMobile'
};
const changePadding = ( type, value ) => {
    switch ( getView ) {
    case 'Desktop':
        if ( 'linked' === attributes.paddingType ) {
            setAttributes({ padding: value,paddingTablet: value, paddingMobile: value });
        } else {
            setAttributes({ [desktopPaddingType[type]]: value });
            setAttributes({ [desktopPaddingType[type]]: value,[tabletPaddingType[type]]: value, [mobilePaddingType[type]]: value });
        }
        break;
    case 'Tablet':
        if ( 'linked' === attributes.paddingTypeTablet ) {
            setAttributes({ paddingTablet: value, paddingMobile: value});
        } else {
            setAttributes({ [tabletPaddingType[type]]: value, [mobilePaddingType[type]]: value });
        }
        break;
    case 'Mobile':
        if ( 'linked' === attributes.paddingTypeMobile ) {
            setAttributes({ paddingMobile: value });
        } else {
            setAttributes({ [mobilePaddingType[type]]: value });
        }
        break;
    }
};

const getPadding = type => {
    if ( 'top' == type ) {
        switch ( getView ) {
        case 'Desktop':
            return 'linked' === attributes.paddingType ? attributes.padding : attributes.paddingTop;
        case 'Tablet':
            return 'linked' === attributes.paddingTypeTablet ? attributes.paddingTablet : attributes.paddingTopTablet;
        case 'Mobile':
            return 'linked' === attributes.paddingTypeMobile ? attributes.paddingMobile : attributes.paddingTopMobile;
        }
    } else if ( 'right' == type ) {
        switch ( getView ) {
        case 'Desktop':
            return 'linked' === attributes.paddingType ? attributes.padding : attributes.paddingRight;
        case 'Tablet':
            return 'linked' === attributes.paddingTypeTablet ? attributes.paddingTablet : attributes.paddingRightTablet;
        case 'Mobile':
            return 'linked' === attributes.paddingTypeMobile ? attributes.paddingMobile : attributes.paddingRightMobile;
        }
    } else if ( 'bottom' == type ) {
        switch ( getView ) {
        case 'Desktop':
            return 'linked' === attributes.paddingType ? attributes.padding : attributes.paddingBottom;
        case 'Tablet':
            return 'linked' === attributes.paddingTypeTablet ? attributes.paddingTablet : attributes.paddingBottomTablet;
        case 'Mobile':
            return 'linked' === attributes.paddingTypeMobile ? attributes.paddingMobile : attributes.paddingBottomMobile;
        }
    } else if ( 'left' == type ) {
        switch ( getView ) {
        case 'Desktop':
            return 'linked' === attributes.paddingType ? attributes.padding : attributes.paddingLeft;
        case 'Tablet':
            return 'linked' === attributes.paddingTypeTablet ? attributes.paddingTablet : attributes.paddingLeftTablet;
        case 'Mobile':
            return 'linked' === attributes.paddingTypeMobile ? attributes.paddingMobile : attributes.paddingLeftMobile;
        }
    }

    return undefined;
  };
     const [paddingUnit, setpaddingUnit] = useState('px');
	 const maxpaddingUnit = paddingUnit === 'px' ? 1500 : paddingUnit === 'em' ? 50 : paddingUnit === '%' ? 100:'';
    // margin
    const getMarginType = () => {
		switch ( getView ) {
		case 'Desktop':
			return attributes.marginType;
		case 'Tablet':
			return attributes.marginTypeTablet;
		case 'Mobile':
			return attributes.marginTypeMobile;
		default:
			return undefined;
		}
	};
	const changeMarginType = value => {
		if ( 'Desktop' === getView ) {
			setAttributes({ marginType: value,marginTypeTablet: value, marginTypeMobile: value });
		} else if ( 'Tablet' === getView ) {
			setAttributes({ marginTypeTablet: value, marginTypeMobile: value });
		} else if ( 'Mobile' === getView ) {
			setAttributes({ marginTypeMobile: value });
		}
	};
	const desktopMarginType = {
		top: 'marginTop',
		right: 'marginRight',
		bottom: 'marginBottom',
		left: 'marginLeft'
	};
	const tabletMarginType = {
		top: 'marginTopTablet',
		right: 'margingRightTablet',
		bottom: 'marginBottomTablet',
		left: 'marginLeftTablet'
	};
	const mobileMarginType = {
		top: 'marginTopMobile',
		right: 'marginRightMobile',
		bottom: 'marginBottomMobile',
		left: 'marginLeftMobile'
	};
	const changeMargin = ( type, value ) => {
		switch ( getView ) {
		case 'Desktop':
			if ( 'linked' === attributes.marginType ) {
				setAttributes({ margin: value, marginTablet: value, marginMobile: value });
			} else {
				setAttributes({ [desktopMarginType[type]]: value,[tabletMarginType[type]]: value, [mobileMarginType[type]]: value });
			}
			break;
		case 'Tablet':
			if ( 'linked' === attributes.marginTypeTablet ) {
				setAttributes({ marginTablet: value, marginMobile: value });
			} else {
				setAttributes({ [tabletMarginType[type]]: value,[mobileMarginType[type]]: value });
			}
			break;
		case 'Mobile':
			if ( 'linked' === attributes.marginTypeMobile ) {
				setAttributes({ marginMobile: value });
			} else {
				setAttributes({ [mobileMarginType[type]]: value });
			}
			break;
		}
	};
	const getMargin = type => {
		if ( 'top' == type ) {
			switch ( getView ) {
			case 'Desktop':
				return 'linked' === attributes.marginType ? attributes.margin : attributes.marginTop;
			case 'Tablet':
				return 'linked' === attributes.marginTypeTablet ? attributes.marginTablet : attributes.marginTopTablet;
			case 'Mobile':
				return 'linked' === attributes.marginTypeMobile ? attributes.marginMobile : attributes.marginTopMobile;
			}
		} else if ( 'right' == type ) {
			switch ( getView ) {
			case 'Desktop':
				return 'linked' === attributes.marginType ? attributes.margin : attributes.marginRight;
			case 'Tablet':
				return 'linked' === attributes.marginTypeTablet ? attributes.marginTablet : attributes.marginRightTablet;
			case 'Mobile':
				return 'linked' === attributes.marginTypeMobile ? attributes.marginMobile : attributes.marginRightMobile;
			}
		} else if ( 'bottom' == type ) {
			switch ( getView ) {
			case 'Desktop':
				return 'linked' === attributes.marginType ? attributes.margin : attributes.marginBottom;
			case 'Tablet':
				return 'linked' === attributes.marginTypeTablet ? attributes.marginTablet : attributes.marginBottomTablet;
			case 'Mobile':
				return 'linked' === attributes.marginTypeMobile ? attributes.marginMobile : attributes.marginBottomMobile;
			}
		} else if ( 'left' == type ) {
			switch ( getView ) {
			case 'Desktop':
				return 'linked' === attributes.marginType ? attributes.margin : attributes.marginLeft;
			case 'Tablet':
				return 'linked' === attributes.marginTypeTablet ? attributes.marginTablet : attributes.marginLeftTablet;
			case 'Mobile':
				return 'linked' === attributes.marginTypeMobile ? attributes.marginMobile : attributes.marginLeftMobile;
			}
		}

		return undefined;
	};
    const [marginUnit, setmarginUnit] = useState('px');
	const maxmarginUnit = marginUnit === 'px' ? 1500 : marginUnit === 'em' ? 50 : marginUnit === '%' ? 100:'';
    
    // icon font size
    const [iconfontSizeUnit, seticonfontSizeUnit] = useState('px');
	const maxiconfontSizeUnit = iconfontSizeUnit === 'px' ? 150 : iconfontSizeUnit === 'em' ? 10 : iconfontSizeUnit === '%' ? 100:'';
	const customTooltipiconfontSize = value => `${value}${attributes.iconfontSizeUnit}`;

	const geticonfontSize = () => {
		switch ( getView ) {
		case 'Desktop':
			return attributes.iconfontSize;
		case 'Tablet':
			return attributes.iconfontSizeTablet;
		case 'Mobile':
			return attributes.iconfontSizeMobile;
		default:
			return undefined;
		}
	};
	const changeiconfontSize = value => {
		if ( 'Desktop' === getView ) {
			setAttributes({ iconfontSize: value, iconfontSizeTablet: value, iconfontSizeMobile: value });
		} else if ( 'Tablet' === getView ) {
			setAttributes({ iconfontSizeTablet: value, iconfontSizeMobile: value });
		} else if ( 'Mobile' === getView ) {
			setAttributes({ iconfontSizeMobile: value });
		}
	};
	// border radius
    const [borderRadiusUnit, setborderRadiusUnit] = useState('px');
	const maxborderRadiusUnit = borderRadiusUnit === 'px' ? 20 : borderRadiusUnit === 'em' ? 5 : borderRadiusUnit === '%' ? 100:'';
	const customTooltipborderRadius = value => `${value}${attributes.borderRadiusUnit}`;

	const getborderRadius = () => {
		switch ( getView ) {
		case 'Desktop':
			return attributes.borderRadius;
		case 'Tablet':
			return attributes.borderRadiusTablet;
		case 'Mobile':
			return attributes.borderRadiusMobile;
		default:
			return undefined;
		}
	};
	const changeborderRadius = value => {
		if ( 'Desktop' === getView ) {
			setAttributes({ borderRadius: value, borderRadiusTablet: value, borderRadiusMobile: value });
		} else if ( 'Tablet' === getView ) {
			setAttributes({ borderRadiusTablet: value, borderRadiusMobile: value });
		} else if ( 'Mobile' === getView ) {
			setAttributes({ borderRadiusMobile: value });
		}
	};
    // price font size
    const [pricefontSizeUnit, setpricefontSizeUnit] = useState('px');
	const maxpricefontSizeUnit = pricefontSizeUnit === 'px' ? 150 : pricefontSizeUnit === 'em' ? 10 : pricefontSizeUnit === '%' ? 100:'';
	const customTooltippricefontSize = value => `${value}${attributes.pricefontSizeUnit}`;

	const getpricefontSize = () => {
		switch ( getView ) {
		case 'Desktop':
			return attributes.pricefontSize;
		case 'Tablet':
			return attributes.pricefontSizeTablet;
		case 'Mobile':
			return attributes.pricefontSizeMobile;
		default:
			return undefined;
		}
	};
	const changepricefontSize = value => {
		if ( 'Desktop' === getView ) {
			setAttributes({ pricefontSize: value, pricefontSizeTablet: value, pricefontSizeMobile: value });
		} else if ( 'Tablet' === getView ) {
			setAttributes({ pricefontSizeTablet: value, pricefontSizeMobile: value });
		} else if ( 'Mobile' === getView ) {
			setAttributes({ pricefontSizeMobile: value });
		}
	};

    // Count size
    const [countSizeUnit, setcountSizeUnit] = useState('px');
	const maxcountSizeUnit = countSizeUnit === 'px' ? 150 : countSizeUnit === 'em' ? 10 : countSizeUnit === '%' ? 100:'';
	const customTooltipcountSize = value => `${value}${attributes.countSizeUnit}`;

	const getcountSize = () => {
		switch ( getView ) {
		case 'Desktop':
			return attributes.countSize;
		case 'Tablet':
			return attributes.countSizeTablet;
		case 'Mobile':
			return attributes.countSizeMobile;
		default:
			return undefined;
		}
	};
	const changecountSize = value => {
		if ( 'Desktop' === getView ) {
			setAttributes({ countSize: value, countSizeTablet: value, countSizeMobile: value });
		} else if ( 'Tablet' === getView ) {
			setAttributes({ countSizeTablet: value, countSizeMobile: value });
		} else if ( 'Mobile' === getView ) {
			setAttributes({ countSizeMobile: value });
		}
	};
    // Count size
    const [countFontSizeUnit, setcountFontSizeUnit] = useState('px');
	const maxcountFontSizeUnit = countFontSizeUnit === 'px' ? 150 : countFontSizeUnit === 'em' ? 10 : countFontSizeUnit === '%' ? 100:'';
	const customTooltipcountFontSize = value => `${value}${attributes.countFontSizeUnit}`;

	const getcountFontSize = () => {
		switch ( getView ) {
		case 'Desktop':
			return attributes.countFontSize;
		case 'Tablet':
			return attributes.countFontSizeTablet;
		case 'Mobile':
			return attributes.countFontSizeMobile;
		default:
			return undefined;
		}
	};
	const changecountFontSize = value => {
		if ( 'Desktop' === getView ) {
			setAttributes({ countFontSize: value, countFontSizeTablet: value, countFontSizeMobile: value });
		} else if ( 'Tablet' === getView ) {
			setAttributes({ countFontSizeTablet: value, countFontSizeMobile: value });
		} else if ( 'Mobile' === getView ) {
			setAttributes({ countFontSizeMobile: value });
		}
    }
    return (<Fragment>
        <InspectorControls>
        <InsSettingHeader value={ tab }
					options={[
						{
							label: __( 'Setting', 'taiowc' ),
							value: 'setting',
                            icon:''
							
						},
						{
							label: __( 'Style', 'taiowc' ),
							value: 'style',
                            icon:''
							
						}
					]}
					onChange={ setTab }
            />
        {'setting' === tab && (  
        <Fragment>     
        <PanelBody
					title={ __( 'All In One Woo Cart', 'taiowc' ) }
					initialOpen={true}
					className="th-sEARCH-panel"
				>   
                        <ToggleControl
								label={ __( 'Display Total Price', 'taiowc' ) }
								checked={ attributes.cartPrice }
								onChange={ cartPrice => setAttributes({cartPrice}) }
							 />
                        <ToggleControl
								label={  __( 'Display Product Count', 'taiowc' ) }
								checked={ attributes.cartCount }
								onChange={ cartCount => setAttributes({cartCount}) }
							 />

                            <SelectControl
								label={ __( 'Count Position', 'taiowc' ) }
								value={ attributes.countPosition }
								options={ [
									{ label: __( 'Left', 'taiowc' ), value: 'left' },
									{ label: __( 'Right', 'taiowc' ), value: 'right' },
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
                </Fragment>
    ) || 'style' === tab && ( 
    <PanelBody
             title={ __( 'All In One Woo Cart Style', 'taiowc' ) }
             initialOpen={true}
             className="th-cart-panel"> 
             <ResponsiveControl
								label={ __( 'Padding', 'taiowc' ) }
							>
							<UnitChooser
								value={ attributes.paddingUnit }
								onClick={paddingUnit => {
									setAttributes({ paddingUnit });
									setpaddingUnit(paddingUnit);
								  }}
								units={ [ 'px', 'em', '%' ] }
						    />	
                            <SizingControl
									type={ getPaddingType() }
									min={ 0 }
									max={maxpaddingUnit}
									changeType={ changePaddingType }
									onChange={ changePadding }
									options={ [
										{
											label: __( 'Top', 'taiowc' ),
											type: 'top',
											value: getPadding( 'top' )
										},
										{
											label: __( 'Right', 'taiowc' ),
											type: 'right',
											value: getPadding( 'right' )
										},
										{
											label: __( 'Bottom', 'taiowc' ),
											type: 'bottom',
											value: getPadding( 'bottom' )
										},
										{
											label: __( 'Left', 'taiowc' ),
											type: 'left',
											value: getPadding( 'left' )
										}
									] }
								/>
							</ResponsiveControl> 
                            <ResponsiveControl
								label={ __( 'Margin', 'taiowc' ) }
							>
							<UnitChooser
								value={ attributes.marginUnit }
								
								onClick={marginUnit => {
									setAttributes({ marginUnit });
									setmarginUnit(marginUnit);
								  }}
								units={ [ 'px', 'em', '%' ] }
						    />
                            <SizingControl
									type={ getMarginType() }
									min={ 0 }
									max={ maxmarginUnit }
									changeType={ changeMarginType }
									onChange={ changeMargin }
									options={ [
										{
											label: __( 'Top', 'taiowc' ),
											type: 'top',
											value: getMargin( 'top' )
										},
										{
											label: __( 'Right', 'taiowc' ),
											type: 'right',
											value: getMargin( 'right' )
										},
										{
											label: __( 'Bottom', 'taiowc' ),
											type: 'bottom',
											value: getMargin( 'bottom' )
										},
										{
											label: __( 'Left', 'taiowc' ),
											type: 'left',
											value: getMargin( 'left' )
										},
									] }
								/>

							</ResponsiveControl>
							<ResponsiveControl
								label={ __( 'border radius', 'taiowc' ) }
							>
								<UnitChooser
								value={ attributes.borderRadiusUnit }
								onClick={borderRadiusUnit => {
									setAttributes({ borderRadiusUnit });
									setborderRadiusUnit(borderRadiusUnit);
								  }}
			
								units={ [ 'px', 'em', '%' ] }
						        />
							<RangeControl
								    renderTooltipContent={ customTooltipborderRadius }
									value={ getborderRadius() || '' }
									onChange={ changeborderRadius }
									step={ 0.1 }
									min={ 0 }
									max={ maxborderRadiusUnit }
									allowReset={ true }
								/>
							</ResponsiveControl>
							
                            <ControlPanelControl
							label={ __( 'Bg Color', 'taiowc' ) }
							attributes={ attributes }
							setAttributes={ setAttributes }
							onClick={ () => setAttributes({ bgSet: true }) }
						   >
                            <ColorGradientControl
								 label={ __( 'Bg Color', 'taiowc' ) }
								 colorValue={ attributes.cartBgClr }
								 onColorChange={ e => setAttributes({ cartBgClr: e }) }
								 enableAlpha={false} 
							/>

                            </ControlPanelControl>
                            <ControlPanelControl
							label={ __( 'Icon style', 'taiowc' ) }
							attributes={ attributes }
							setAttributes={ setAttributes }
							onClick={ () => setAttributes({ iconSet: true }) }
						   >
                            <ColorGradientControl
								label={ __( 'Color', 'taiowc' ) }
								colorValue={ attributes.iconClr }
								onColorChange={ e => setAttributes({ iconClr: e }) }
								enableAlpha={true} 
							/> 
                            <ResponsiveControl
								label={ __( 'Font Size', 'taiowc' ) }
							     >	
								<UnitChooser
								value={ attributes.iconfontSizeUnit }
								onClick={iconfontSizeUnit => {
									setAttributes({ iconfontSizeUnit });
									seticonfontSizeUnit(iconfontSizeUnit);
								  }}
			
								units={ [ 'px', 'em', '%' ] }
						        />
								<RangeControl
								    renderTooltipContent={ customTooltipiconfontSize }
									value={ geticonfontSize() || '' }
									onChange={ changeiconfontSize }
									step={ 0.1 }
									min={ 0 }
									max={ maxiconfontSizeUnit }
									allowReset={ true }
								/>
							</ResponsiveControl>   
                            </ControlPanelControl>
                            <ControlPanelControl
							label={ __( 'Price style', 'taiowc' ) }
							attributes={ attributes }
							setAttributes={ setAttributes }
							onClick={ () => setAttributes({ priceSet: true }) }
						   >
                            <ColorGradientControl
								label={ __( 'Color', 'taiowc' ) }
								colorValue={ attributes.priceClr }
								onColorChange={ e => setAttributes({ priceClr: e }) }
								enableAlpha={true} 
							/> 
                            <ResponsiveControl
								label={ __( 'Font Size', 'taiowc' ) }
							     >	
								<UnitChooser
								value={ attributes.pricefontSizeUnit }
								onClick={pricefontSizeUnit => {
									setAttributes({ pricefontSizeUnit });
									setpricefontSizeUnit(pricefontSizeUnit);
								  }}
			
								units={ [ 'px', 'em', '%' ] }
						        />
								<RangeControl
								    renderTooltipContent={ customTooltippricefontSize }
									value={ getpricefontSize() || '' }
									onChange={ changepricefontSize }
									step={ 0.1 }
									min={ 0 }
									max={ maxpricefontSizeUnit }
									allowReset={ true }
								/>
							</ResponsiveControl>     
                        </ControlPanelControl>
                        <ControlPanelControl
							label={ __( 'Count style', 'taiowc' ) }
							attributes={ attributes }
							setAttributes={ setAttributes }
							onClick={ () => setAttributes({ countSet: true }) }
						   >
							
                            <ColorGradientControl
								label={ __( 'Color', 'taiowc' ) }
								colorValue={ attributes.countClr }
								onColorChange={ e => setAttributes({ countClr: e }) }
								enableAlpha={true} 
							/>
                            <ColorGradientControl
								label={ __( 'BgColor', 'taiowc' ) }
								colorValue={ attributes.countBgClr }
								onColorChange={ e => setAttributes({ countBgClr: e }) }
								enableAlpha={true} 
							/>  
                            <ResponsiveControl
								label={ __( 'Count Size', 'taiowc' ) }
							     >	
								<UnitChooser
								value={ attributes.countSizeUnit }
								onClick={countSizeUnit => {
									setAttributes({ countSizeUnit });
									setcountSizeUnit(countSizeUnit);
								  }}
			
								units={ [ 'px', 'em', '%' ] }
						        />
								<RangeControl
								    renderTooltipContent={ customTooltipcountSize }
									value={ getcountSize() || '' }
									onChange={ changecountSize }
									step={ 0.1 }
									min={ 0 }
									max={ maxcountSizeUnit }
									allowReset={ true }
								/>
							</ResponsiveControl> 
                            <ResponsiveControl
								label={ __( 'Count Font Size', 'taiowc' ) }
							     >	
								<UnitChooser
								value={ attributes.countFontSizeUnit }
								onClick={countFontSizeUnit => {
									setAttributes({ countFontSizeUnit });
									setcountFontSizeUnit(countFontSizeUnit);
								  }}
			
								units={ [ 'px', 'em', '%' ] }
						        />
								<RangeControl
								    renderTooltipContent={ customTooltipcountFontSize }
									value={ getcountFontSize() || '' }
									onChange={ changecountFontSize }
									step={ 0.1 }
									min={ 0 }
									max={ maxcountFontSizeUnit }
									allowReset={ true }
								/>
							</ResponsiveControl>   
                        </ControlPanelControl>

    </PanelBody>
)}      
        </InspectorControls>
    </Fragment>)   
}

export default InsSettings;
