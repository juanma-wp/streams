import { Button } from "@wordpress/components";
import { useDispatch, useSelect } from "@wordpress/data";
import { store as coreDataStore } from "@wordpress/core-data";
import { store as noticesStore } from "@wordpress/notices";
import { Spinner } from "@wordpress/components";

export const ButtonDeletePage = ({ pageId }) => {
  const { createSuccessNotice, createErrorNotice } = useDispatch(noticesStore);
  const { deleteEntityRecord } = useDispatch(coreDataStore);
  const { getLastEntityDeleteError } = useSelect(coreDataStore);
  const { isDeleting } = useSelect(
    (select) => ({
      isDeleting: select(coreDataStore).isDeletingEntityRecord(
        "postType",
        "page",
        pageId
      ),
    }),
    [pageId]
  );

  const handleDelete = async () => {
    const success = await deleteEntityRecord("postType", "page", pageId);
    if (success) {
      createSuccessNotice("The page was deleted!", {
        type: "snackbar",
      });
    } else {
      const lastError = getLastEntityDeleteError("postType", "page", pageId);
      const message =
        (lastError?.message || "There was an error.") +
        " Please refresh the page and try again.";
      createErrorNotice(message, {
        type: "snackbar",
      });
    }
  };

  return (
    <Button variant="primary" onClick={handleDelete}>
      {isDeleting ? (
        <>
          <Spinner />
          Deleting...
        </>
      ) : (
        "Delete"
      )}
    </Button>
  );
};
