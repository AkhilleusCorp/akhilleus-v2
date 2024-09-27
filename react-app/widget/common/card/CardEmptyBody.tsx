import React, {ReactNode} from 'react';

type CardEmptyBodyType = {
    title: string;
    children: ReactNode
}

const CardEmptyBody: React.FC<CardEmptyBodyType> = ({ title, children }) => {
    return (
        <>
            <div className={"card-body card-body-empty"}>
                <div className={"card-title"}>{title}</div>
                <div className={"card-content"}>
                    {children}
                </div>
            </div>
        </>
    );
}

export default CardEmptyBody;