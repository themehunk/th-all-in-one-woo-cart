/**
 * WordPress dependencies.
 */
/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';
import classnames from 'classnames';
import { useViewportMatch, useMediaQuery} from '@wordpress/compose';
import { useSelect, useDispatch  } from '@wordpress/data';

import hexToRgba from 'hex-rgba';
import {
	useEffect
} from '@wordpress/element';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { RichText, useBlockProps } from '@wordpress/block-editor';

/**
 * Internal dependencies
 */

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';
import InsSettings from './settings.js';


export default function Edit({ attributes, 
	setAttributes, 
	clientId,
	uniqueID }) {

let counter = 0;
function getUniqueId( uniqueID, clientId, isUniqueID, isUniqueBlock ) {
    
    let smallID = '_' + clientId.substr( 2, 9 );
    if ( ! uniqueID ) {
        //new block
        if ( ! isUniqueID( smallID ) ) {
            smallID = generateUniqueId(smallID);
        }
        return smallID;
    } else if ( ! isUniqueID( uniqueID ) ) {
        // This checks if we are just switching views, client ID the same means we don't need to update.
        if ( ! isUniqueBlock( uniqueID, clientId ) ) {
            return smallID
        }
    }
    //normal block loading 
    return uniqueID;
}

function generateUniqueId(smallID) {
  counter += 1;
  return `${smallID}${counter}`;
}

      const { id } = attributes;
			const { addUniqueID } = useDispatch( 'taiowc/data' );
			const { isUniqueID, isUniqueBlock} = useSelect(
				( select ) => {
					return {
						isUniqueID: ( value ) => select( 'taiowc/data' ).isUniqueID( value ),
						isUniqueBlock: ( value, clientId ) => select( 'taiowc/data' ).isUniqueBlock( value, clientId ),
						
					};
				},
				[ clientId ]
			);

			useEffect( () => {
			const uniqueId = getUniqueId( uniqueID, clientId, isUniqueID, isUniqueBlock );
			if ( uniqueId !== uniqueID ) {
				attributes.uniqueID = uniqueId;
				setAttributes( { uniqueID: uniqueId } );
				addUniqueID( uniqueId, clientId );
			} else {
				addUniqueID( uniqueId, clientId );
			}
			}, [] );

      const ThiconStyle = ({ cartIconAttr }) => {
        
          return <span className="th-icon th-icon-Shopping_icons-01"></span>;
        
      };

      let countPositionVar;

        if (attributes.countPosition === 'left') {
            countPositionVar = 'count-left';
        } else if (attributes.countPosition === 'right') {
            countPositionVar = 'count-right';
        }

        const {
            isViewportAvailable,
            isPreviewDesktop,
            isPreviewTablet,
            isPreviewMobile
          } = useSelect( select => {
            const { __experimentalGetPreviewDeviceType } = select( 'core/edit-post' ) ? select( 'core/edit-post' ) : false;
            return {
              isViewportAvailable: __experimentalGetPreviewDeviceType ? true : false,
              isPreviewDesktop: __experimentalGetPreviewDeviceType ? 'Desktop' === __experimentalGetPreviewDeviceType() : false,
              isPreviewTablet: __experimentalGetPreviewDeviceType ? 'Tablet' === __experimentalGetPreviewDeviceType() : false,
              isPreviewMobile: __experimentalGetPreviewDeviceType ? 'Mobile' === __experimentalGetPreviewDeviceType() : false
            };
          }, []);
        
          const isLarger = useViewportMatch( 'large', '>=' );
        
          const isLarge = useViewportMatch( 'large', '<=' );
        
          const isSmall = useViewportMatch( 'small', '>=' );
        
          const isSmaller = useViewportMatch( 'small', '<=' );
        
          let isDesktop = isLarger && ! isLarge && isSmall && ! isSmaller;
        
          let isTablet = ! isLarger && ! isLarge && isSmall && ! isSmaller;
        
          let isMobile = ! isLarger && ! isLarge && ! isSmall && ! isSmaller;
        
          if ( isViewportAvailable && ! isMobile ) {
            isDesktop = isPreviewDesktop;
            isTablet = isPreviewTablet;
            isMobile = isPreviewMobile;
          }
    
          const deviceAttributeMap = {
            desktop: {
                paddingTop: 'linked' === attributes.paddingType ? `${ attributes.padding }${ attributes.paddingUnit }` : `${ attributes.paddingTop }${ attributes.paddingUnit }`,
                paddingRight: 'linked' === attributes.paddingType ? `${ attributes.padding }${ attributes.paddingUnit }` : `${ attributes.paddingRight }${ attributes.paddingUnit }`,
                paddingBottom: 'linked' === attributes.paddingType ? `${ attributes.padding }${ attributes.paddingUnit }` : `${ attributes.paddingBottom }${ attributes.paddingUnit }`,
                paddingLeft: 'linked' === attributes.paddingType ? `${ attributes.padding }${ attributes.paddingUnit }` : `${ attributes.paddingLeft }${ attributes.paddingUnit }`,
              
                marginTop: 'linked' === attributes.marginType ? `${ attributes.margin }${ attributes.marginUnit }` : `${ attributes.marginTop }${ attributes.marginUnit }`,
                marginBottom: 'linked' === attributes.marginType ? `${ attributes.margin }${ attributes.marginUnit }` : `${ attributes.marginBottom }${ attributes.marginUnit }`,
                marginRight: 'linked' === attributes.marginType ? `${ attributes.margin }${ attributes.marginUnit }` : `${ attributes.marginRight }${ attributes.marginUnit }`,
                marginLeft: 'linked' === attributes.marginType ? `${ attributes.margin }${ attributes.marginUnit }` : `${ attributes.marginLeft }${ attributes.marginUnit }`,   
                
                pricefontSize: attributes.pricefontSize + attributes.pricefontSizeUnit,
                iconfontSize: attributes.iconfontSize + attributes.iconfontSizeUnit,
    
                countSize: attributes.countSize + attributes.countSizeUnit,
                countFontSize: attributes.countFontSize + attributes.countFontSizeUnit,
    
                borderRadius: attributes.borderRadius + attributes.borderRadiusUnit,
            },
            tablet: {
              paddingTop: 'linked' === attributes.paddingTypeTablet ? `${ attributes.paddingTablet }${ attributes.paddingUnit }` : `${ attributes.paddingTopTablet }${ attributes.paddingUnit }`,
              paddingRight: 'linked' === attributes.paddingTypeTablet ? `${ attributes.paddingTablet }${ attributes.paddingUnit }` : `${ attributes.paddingRightTablet }${ attributes.paddingUnit }`,
              paddingBottom: 'linked' === attributes.paddingTypeTablet ? `${ attributes.paddingTablet }${ attributes.paddingUnit }` : `${ attributes.paddingBottomTablet }${ attributes.paddingUnit }`,
              paddingLeft: 'linked' === attributes.paddingTypeTablet ? `${ attributes.paddingTablet }${ attributes.paddingUnit }` : `${ attributes.paddingLeftTablet }${ attributes.paddingUnit }`,
            
              marginTop: 'linked' === attributes.marginTypeTablet ? `${ attributes.marginTablet }${ attributes.marginUnit }` : `${ attributes.marginTopTablet }${ attributes.marginUnit }`,
              marginBottom: 'linked' === attributes.marginTypeTablet ? `${ attributes.marginTablet }${ attributes.marginUnit }` : `${ attributes.marginBottomTablet }${ attributes.marginUnit }`,
              marginRight: 'linked' === attributes.marginTypeTablet ? `${ attributes.marginTablet }${ attributes.marginUnit }` : `${ attributes.marginRightTablet }${ attributes.marginUnit }`,
              marginLeft: 'linked' === attributes.marginTypeTablet ? `${ attributes.marginTablet }${ attributes.marginUnit }` : `${ attributes.marginLeftTablet }${ attributes.marginUnit }`,   
           
              pricefontSize: attributes.pricefontSizeTablet + attributes.pricefontSizeUnit,
              iconfontSize: attributes.iconfontSizeTablet + attributes.iconfontSizeUnit,
    
              countSize: attributes.countSizeTablet + attributes.countSizeUnit,
              countFontSize: attributes.countFontSizeTablet + attributes.countFontSizeUnit,
              borderRadius: attributes.borderRadiusTablet + attributes.borderRadiusUnit,
           
            },
    
            mobile: {
              paddingTop: 'linked' === attributes.paddingTypeMobile ? `${ attributes.paddingMobile }${ attributes.paddingUnit }` : `${ attributes.paddingTopMobile }${ attributes.paddingUnit }`,
              paddingRight: 'linked' === attributes.paddingTypeMobile ? `${ attributes.paddingMobile }${ attributes.paddingUnit }` : `${ attributes.paddingRightMobile }${ attributes.paddingUnit }`,
              paddingBottom: 'linked' === attributes.paddingTypeMobile ? `${ attributes.paddingMobile }${ attributes.paddingUnit }` : `${ attributes.paddingBottomMobile }${ attributes.paddingUnit }`,
              paddingLeft: 'linked' === attributes.paddingTypeMobile ? `${ attributes.paddingMobile }${ attributes.paddingUnit }` : `${ attributes.paddingLeftMobile }${ attributes.paddingUnit }`,
              
              marginTop: 'linked' === attributes.marginTypeMobile ? `${ attributes.marginMobile }${ attributes.marginUnit }` : `${ attributes.marginTopMobile }${ attributes.marginUnit }`,
              marginBottom: 'linked' === attributes.marginTypeMobile ? `${ attributes.marginMobile }${ attributes.marginUnit }` : `${ attributes.marginBottomMobile }${ attributes.marginUnit }`,
              marginRight: 'linked' === attributes.marginTypeMobile ? `${ attributes.marginMobile }${ attributes.marginUnit }` : `${ attributes.marginRightMobile }${ attributes.marginUnit }`,
              marginLeft: 'linked' === attributes.marginTypeMobile ? `${ attributes.marginMobile }${ attributes.marginUnit }` : `${ attributes.marginLeftMobile }${ attributes.marginUnit }`,   
              
              pricefontSize: attributes.pricefontSizeMobile + attributes.pricefontSizeUnit,
              iconfontSize: attributes.iconfontSizeMobile + attributes.iconfontSizeUnit,
    
              countSize: attributes.countSizeMobile + attributes.countSizeUnit,
              countFontSize: attributes.iconFontSizeMobile + attributes.countFontSizeUnit,
              borderRadius: attributes.borderRadiusMobile + attributes.borderRadiusUnit,
    
            }
    
          }
          const deviceType    = isDesktop ? 'desktop' : isTablet ? 'tablet' : 'mobile';
          const PaddingTop    = deviceAttributeMap[deviceType].paddingTop;
          const PaddingBottom = deviceAttributeMap[deviceType].paddingBottom;
          const PaddingRight  = deviceAttributeMap[deviceType].paddingRight;
          const PaddingLeft   = deviceAttributeMap[deviceType].paddingLeft;
    
          const MarginTop     = deviceAttributeMap[deviceType].marginTop;
          const MarginBottom  = deviceAttributeMap[deviceType].marginBottom;
          const MarginRight   = deviceAttributeMap[deviceType].marginRight;
          const MarginLeft    = deviceAttributeMap[deviceType].marginLeft;
    
          const IconFontSize  = deviceAttributeMap[deviceType].iconfontSize;
          const PriceFontSize = deviceAttributeMap[deviceType].pricefontSize;
    
          const CountSize     = deviceAttributeMap[deviceType].countSize;
          const CountFontSize = deviceAttributeMap[deviceType].countFontSize;
          const BorderRadius = deviceAttributeMap[deviceType].borderRadius;
    
          let taiowcStyle;
    
          taiowcStyle = {
    
            '--taiowc-padding-top':PaddingTop,
            '--taiowc-padding-bottom':PaddingBottom,
            '--taiowc-padding-right':PaddingRight,
            '--taiowc-padding-left':PaddingLeft,
    
            '--taiowc-margin-top':MarginTop,
            '--taiowc-margin-bottom':MarginBottom,
            '--taiowc-margin-right':MarginRight,
            '--taiowc-margin-left':MarginLeft,
    
            '--taiowc-icon-font-size':IconFontSize,
            '--taiowc-price-font-size':PriceFontSize,
    
            '--taiowc-count-size':CountSize,
            '--taiowc-count-font-size':CountFontSize,
    
            '--taiowc-brd-radius':BorderRadius,
    
            '--taiowc-cartBgClr':attributes.cartBgClr,
            '--taiowc-iconClr':attributes.iconClr,
            '--taiowc-priceClr':attributes.priceClr,
            '--taiowc-countClr':attributes.countClr,
            '--taiowc-countBgClr':attributes.countBgClr,
    
          }

          const omitBy = (object, condition) => (
            Object.fromEntries(
              Object.entries(object).filter(([key, value]) => !condition(value))
            )
            );
    
          const style = omitBy({
            ...taiowcStyle,
          }, x => x?.includes?.( 'undefined' ));


        const blockProps = useBlockProps({
                           id:`taiowc-${attributes.uniqueID}`,
                          className: 'taiowc-wrapper',
                          style
                          });
        return (
			    <>
            <InsSettings
              attributes={attributes}
              setAttributes={setAttributes}
            />
            <div { ...blockProps }>
            <div className='th-minicart'> 
            <div className='th-minicart-icon'>
            <ThiconStyle cartIconAttr={attributes.cartIcon} />
            </div> 
            {attributes.cartPrice === true && (
            <div className='th-minicart-amt'>
            <span>$00.0</span>
            </div> 
            )}
            {attributes.cartCount === true && (
            <div className={`th-minicart-count ${countPositionVar}`}>
            <span>00</span>
            </div> 
            )}
            
            </div> 
            </div>
            
            </>
        )
}