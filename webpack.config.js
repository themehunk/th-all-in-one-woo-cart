const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
module.exports = {
	...defaultConfig,
  entry:{
     'taiowc':'./src/block/taiowc',
     'taiowc-data':'./src/data',
     'component-editor': './src/block/taiowc/components/component-editor.scss',
  }
};