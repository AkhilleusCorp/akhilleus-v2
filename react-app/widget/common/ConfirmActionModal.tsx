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
        <div className={"overlay"}>
            <div className={"modal"}>
                <h2>Confirmation</h2>
                <p>Êtes-vous sûr de vouloir continuer ?</p>
                <div>
                    <button onClick={onCancel} className={"btn-cancel"}>Cancel</button>
                    <button onClick={onConfirmClick} className={"btn-validate"}>Confirm</button>
                </div>
            </div>
        </div>
    );
}

export default ConfirmActionModal;