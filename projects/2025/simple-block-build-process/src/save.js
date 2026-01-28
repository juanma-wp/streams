import { useBlockProps } from "@wordpress/block-editor";

export default function save() {
	return (
		<p {...useBlockProps.save()}>
			{"Simple Block Build Process – hello from the saved content!"}
		</p>
	);
}
