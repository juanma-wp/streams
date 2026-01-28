const [
	defaultConfigNonModule,
	defaultConfigModule,
] = require("@wordpress/scripts/config/webpack.config");

module.exports = [
	{
		...defaultConfigNonModule,
		entry: {
			registerFormatType: "./src/registerFormatType.js",
		},
	},
	{
		...defaultConfigModule,
	},
];
