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
	setAttributes }) {
    
      const ThiconStyle = ({ cartIconAttr }) => {
        
          return <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag w-6 h-6 stroke-[1.5px]" aria-hidden="true"><path d="M16 10a4 4 0 0 1-8 0"></path><path d="M3.103 6.034h17.794"></path><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path></svg>;
        
      };

      let countPositionVar;

        if (attributes.countPosition === 'left') {
            countPositionVar = 'count-left';
        } else if (attributes.countPosition === 'right') {
            countPositionVar = 'count-right';
        }

        // Utility function to generate a unique ID
    const generateUniqueId = () => {
      const randomPart = Math.random().toString(36).substring(2, 10); // Generate random alphanumeric string
      return `-${randomPart}`;
    };
  
  // Ensure the uniqueID is set if it's not
  if (!attributes.uniqueID) {
      setAttributes({ uniqueID: generateUniqueId() });
  }
      //view port
      const {
        isViewportAvailable,
        isPreviewDesktop,
        isPreviewTablet,
        isPreviewMobile,
    } = useSelect((select) => {
        const { getDeviceType } = select('core/editor') || {};
    
        return {
            isViewportAvailable: !!getDeviceType,
            isPreviewDesktop: getDeviceType ? getDeviceType() === 'Desktop' : false,
            isPreviewTablet: getDeviceType ? getDeviceType() === 'Tablet' : false,
            isPreviewMobile: getDeviceType ? getDeviceType() === 'Mobile' : false,
        };
    }, []);
    
    const isLarger = useViewportMatch('large', '>=');
    const isLarge = useViewportMatch('large', '<=');
    const isSmall = useViewportMatch('small', '>=');
    const isSmaller = useViewportMatch('small', '<=');
    
    let isDesktop = isLarger && !isLarge && isSmall && !isSmaller;
    let isTablet = !isLarger && !isLarge && isSmall && !isSmaller;
    let isMobile = !isLarger && !isLarge && !isSmall && !isSmaller;
    
    if (isViewportAvailable && !isMobile) {
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