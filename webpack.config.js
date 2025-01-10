const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
module.exports = {
	...defaultConfig,
  entry:{
     'taiowc':'./src/block/taiowc',
     'component-editor': './src/block/taiowc/components/component-editor.scss',
  }
};