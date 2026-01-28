import { useSelect, useDispatch } from "@wordpress/data";
import { store as coreDataStore } from "@wordpress/core-data";
import { PageForm } from "./PageForm";

export const PageFormEdit = ({ pageId, onCancel, onSaveFinished }) => {
  const { isSaving, hasEdits, lastError, page } = useSelect(
    (select) => ({
      page: select(coreDataStore).getEditedEntityRecord(
        "postType",
        "page",
        pageId
      ),
      lastError: select(coreDataStore).getLastEntitySaveError(
        "postType",
        "page",
        pageId
      ),
      isSaving: select(coreDataStore).isSavingEntityRecord(
        "postType",
        "page",
        pageId
      ),
      hasEdits: select(coreDataStore).hasEditsForEntityRecord(
        "postType",
        "page",
        pageId
      ),
    }),
    [pageId]
  );

  const { editEntityRecord } = useDispatch(coreDataStore);
  const handleChange = (title) =>
    editEntityRecord("postType", "page", pageId, { title });

  const { saveEditedEntityRecord } = useDispatch(coreDataStore);
  const handleSave = async () => {
    const updatedRecord = await saveEditedEntityRecord(
      "postType",
      "page",
      pageId
    );
    if (updatedRecord) {
      onSaveFinished();
    }
  };

  return (
    <PageForm
      title={page.title}
      onChangeTitle={handleChange}
      hasEdits={hasEdits}
      lastError={lastError}
      isSaving={isSaving}
      onCancel={onCancel}
      onSave={handleSave}
    />
  );
};
