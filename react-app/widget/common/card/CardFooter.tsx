import React, {ReactNode} from 'react';

type CardFooterType = {
    shouldBeDisplayed: boolean,
    children: ReactNode
}

const CardFooter: React.FC<CardFooterType> = ({ shouldBeDisplayed, children }) => {
    if (!shouldBeDisplayed) {
        return <></>;
    }

    return (
        <div className={"card-footer"}>
            {children}
        </div>
    );
}

export default CardFooter;