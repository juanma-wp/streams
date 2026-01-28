import { __ } from "@wordpress/i18n";
import { useBlockProps } from "@wordpress/block-editor";

const text = <p>Hello Wo____rld!</p>;
export default function Edit() {
	return (
		<div {...useBlockProps()}>
			{text}
			<p>
				{__(
					"Simple Block Build Process – hello from the editor!",
					"simple-block-build-process",
				)}
			</p>
		</div>
	);
}
