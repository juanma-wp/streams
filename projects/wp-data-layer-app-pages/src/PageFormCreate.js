import { useState } from "@wordpress/element";
import { useDispatch, useSelect } from "@wordpress/data";
import { store as coreDataStore } from "@wordpress/core-data";
import { PageForm } from "./PageForm";

export function PageFormCreate({ onCancel, onSaveFinished }) {
  const [title, setTitle] = useState();
  const { lastError, isSaving } = useSelect(
    (select) => ({
      // Notice the missing pageId argument:
      lastError: select(coreDataStore).getLastEntitySaveError(
        "postType",
        "page"
      ),
      // Notice the missing pageId argument
      isSaving: select(coreDataStore).isSavingEntityRecord("postType", "page"),
    }),
    []
  );
  const { saveEntityRecord } = useDispatch(coreDataStore);
  const handleChange = (title) => setTitle(title);
  const handleSave = async () => {
    const savedRecord = await saveEntityRecord("postType", "page", {
      title,
      status: "publish",
    });
    if (savedRecord) {
      onSaveFinished();
    }
  };
  return (
    <PageForm
      title={title}
      onChangeTitle={handleChange}
      hasEdits={!!title}
      onSave={handleSave}
      onCancel={onCancel}
      lastError={lastError}
      isSaving={isSaving}
    />
  );
}
