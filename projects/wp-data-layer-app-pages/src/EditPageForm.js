import { Button, TextControl } from "@wordpress/components";
import { useSelect } from "@wordpress/data";
import { store as coreDataStore } from "@wordpress/core-data";

export const EditPageForm = ({ pageId, onCancel, onSaveFinished }) => {
  const page = useSelect(
    (select) =>
      select(coreDataStore).getEntityRecord("postType", "page", pageId),
    [pageId]
  );
  return (
    <div className="my-gutenberg-form">
      <TextControl label="Page title:" value={page.title.rendered} />
      <div className="form-buttons">
        <Button onClick={onSaveFinished} variant="primary">
          Save
        </Button>
        <Button onClick={onCancel} variant="tertiary">
          Cancel
        </Button>
      </div>
    </div>
  );
};
