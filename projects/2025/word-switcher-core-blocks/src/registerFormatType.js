import { toggleFormat, registerFormatType } from "@wordpress/rich-text";
import { RichTextToolbarButton } from "@wordpress/block-editor";

const WORD_SWITCHER_FORMAT_TYPE = "word-switcher/format-type-delimiter";

registerFormatType(WORD_SWITCHER_FORMAT_TYPE, {
	title: "Word Switcher",
	tagName: "span",
	className: "word-switcher",
	edit: ({ isActive, onChange, value }) => {
		return (
			<RichTextToolbarButton
				icon="update"
				title="Mark as Word Switcher Area"
				onClick={() => {
					onChange(
						toggleFormat(value, {
							type: WORD_SWITCHER_FORMAT_TYPE,
						}),
					);
				}}
				isActive={isActive}
			/>
		);
	},
});
