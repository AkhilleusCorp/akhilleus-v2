import React from 'react';

type ConfirmActionModelType = {
    targetId: number|null;
    onCancel: () => void;
    onConfirm: (targetId: number) => void
}
const ConfirmActionModal: React.FC<ConfirmActionModelType> = ({ targetId, onCancel, onConfirm }) => {
    if (null == targetId) {
        return null;
    }

    const onConfirmClick = () => {
        onConfirm(targetId);
    }

    return (
        <div className={"modal-overlay"}>
            <div className={"modal"}>
                <h3>Confirmation</h3>
                <p>
                    Are you sure you want to delete user #{targetId} ? <br />
                    <strong>This operation is irreversible !</strong>
                </p>
                <div>
                    <button onClick={onCancel} className={"btn-cancel"}>Cancel</button>
                    <button onClick={onConfirmClick} className={"btn-danger"}>Confirm</button>
                </div>
            </div>
        </div>
    );
}

export default ConfirmActionModal;