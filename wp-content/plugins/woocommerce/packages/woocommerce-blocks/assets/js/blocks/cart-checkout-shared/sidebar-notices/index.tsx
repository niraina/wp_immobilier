/**
 * External dependencies
 */
import { createHigherOrderComponent } from '@wordpress/compose';
import {
	InspectorControls,
	store as blockEditorStore,
} from '@wordpress/block-editor';
import { addFilter, hasFilter } from '@wordpress/hooks';
import type { StoreDescriptor } from '@wordpress/data';
import { CartCheckoutSidebarCompatibilityNotice } from '@woocommerce/editor-components/sidebar-compatibility-notice';
import {
	DefaultNotice,
	LegacyNotice,
} from '@woocommerce/editor-components/default-notice';
import { useSelect } from '@wordpress/data';
import { CartCheckoutFeedbackPrompt } from '@woocommerce/editor-components/feedback-prompt';
import { isWcVersion } from '@woocommerce/settings';
declare module '@wordpress/editor' {
	let store: StoreDescriptor;
}

declare module '@wordpress/core-data' {
	let store: StoreDescriptor;
}

declare module '@wordpress/block-editor' {
	let store: StoreDescriptor;
}

const withSidebarNotices = createHigherOrderComponent(
	( BlockEdit ) => ( props ) => {
		const { name: blockName, isSelected: isBlockSelected } = props;

		// Show sidebar notices only when a WooCommerce block is selected.
		if ( ! blockName.startsWith( 'woocommerce/' ) || ! isBlockSelected ) {
			return <BlockEdit key="edit" { ...props } />;
		}

		const addressFieldOrAccountBlocks = [
			'woocommerce/checkout-shipping-address-block',
			'woocommerce/checkout-billing-address-block',
			'woocommerce/checkout-contact-information-block',
			'woocommerce/checkout-fields-block',
		];
		const { clientId } = props;
		const { isCart, isCheckout, isAddressFieldBlock } = useSelect(
			( select ) => {
				const { getBlockParentsByBlockName, getBlockName } =
					select( blockEditorStore );
				const parent = getBlockParentsByBlockName( clientId, [
					'woocommerce/cart',
					'woocommerce/checkout',
				] ).map( getBlockName );
				const currentBlockName = getBlockName( clientId );
				return {
					isCart:
						parent.includes( 'woocommerce/cart' ) ||
						currentBlockName === 'woocommerce/cart',
					isCheckout:
						parent.includes( 'woocommerce/checkout' ) ||
						currentBlockName === 'woocommerce/checkout',
					isAddressFieldBlock:
						addressFieldOrAccountBlocks.includes(
							currentBlockName
						),
				};
			}
		);
		return (
			<>
				{ ( isCart || isCheckout ) && (
					<InspectorControls>
						{ isWcVersion( '6.9.0', '>=' ) ? (
							<DefaultNotice
								block={ isCheckout ? 'checkout' : 'cart' }
							/>
						) : (
							<LegacyNotice
								block={ isCheckout ? 'checkout' : 'cart' }
							/>
						) }

						<CartCheckoutSidebarCompatibilityNotice
							block={ isCheckout ? 'checkout' : 'cart' }
						/>
						{ isAddressFieldBlock ? null : (
							<CartCheckoutFeedbackPrompt />
						) }
					</InspectorControls>
				) }

				<BlockEdit key="edit" { ...props } />
			</>
		);
	},
	'withSidebarNotices'
);

if (
	! hasFilter(
		'editor.BlockEdit',
		'woocommerce/add/sidebar-compatibility-notice'
	)
) {
	addFilter(
		'editor.BlockEdit',
		'woocommerce/add/sidebar-compatibility-notice',
		withSidebarNotices,
		11
	);
}
